<!DOCTYPE html>
<html>
<head>
    <title>Cards + Effects CRUD</title>
    <style>
        select {
            color: #000 !important;
            background-color: #fff !important;
            color-scheme: light;
        }

        select option {
            color: #000 !important;
            background-color: #fff !important;
        }

        body { 
            font-family: sans-serif; 
            max-width: 900px; 
            margin: 40px auto; 
            background-color: #03ad7aff;
            color: black;
        }

        input, textarea, select { 
            width: 100%; 
            margin-bottom: 10px; 
            padding: 6px; 
        }

        .flex-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .flex-row label {
            margin-bottom: 0;
            width: auto;
            font-weight: bold;
        }

        .effect-group { 
            border: 1px solid #ccc; 
            padding: 10px; 
            margin-bottom: 10px; 
            position: relative; 
            background-color: #f0f0f0; 
            border-radius: 6px;
        }

        .remove-btn { 
            position: absolute; 
            top: 5px; 
            right: 5px; 
            background:#dc2626; 
            color:white; 
            border:none; 
            padding:4px 8px; 
            cursor:pointer; 
        }

        button.add-effect { 
            margin-bottom: 20px; 
            padding:8px 16px; 
            background:#2563eb; 
            color:white; 
            border:none; 
            cursor:pointer; 
            border-radius:6px;
        }

        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 30px; 
            background-color: #f0f0f0; 
            border-radius: 6px;
        }

        table, th, td { 
            border: 1px solid #ccc; 
        }

        th, td { 
            padding: 8px; 
            text-align: left; 
        }

        .delete-btn { background-color:#dc2626; color:white; }
        .save-btn { background-color:#16a34a; color:white; }
        .edit-btn { background:#2563eb; color:white; padding:4px 8px; text-decoration:none; border-radius:4px; }
        .home-btn { padding:8px 16px; background:#2563eb; color:white; border:none; border-radius:6px; text-decoration:none; }
    </style>
</head>
<body>

<?php
    $isEdit = isset($card);
?>

<a href="/" class="home-btn">← Return to Home</a>

<h1><?php echo e($isEdit ? 'Edit Card + Effects' : 'Add Card + Effects'); ?></h1>

<?php if(session('success')): ?>
    <p style="color:lightgreen;"><?php echo e(session('success')); ?></p>
<?php endif; ?>

<?php if($errors->any()): ?>
    <ul style="color:red;">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<form method="POST" action="<?php echo e($isEdit ? route('cards.update', $card->card_id) : route('cards.store')); ?>">
<?php echo csrf_field(); ?>
<?php if($isEdit): ?>
    <?php echo method_field('PUT'); ?>
<?php endif; ?>




<h2>Card Info</h2>

<label>Card Name</label>
<input type="text" name="card_name"
       value="<?php echo e(old('card_name', $card->card_name ?? '')); ?>"
       required>

<div class="flex-row">
    <label>Card Type</label>
    <label>Handtrap?</label>
</div>

<div style="display: flex; gap: 10px;">
    <select name="card_category_id" required style="flex: 2;">
        <option value="" disabled>— Select Card Category —</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->card_category_id); ?>"
                <?php echo e(old('card_category_id', $card->card_category_id ?? null) == $category->card_category_id ? 'selected' : ''); ?>>
                <?php echo e($category->category_name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <select name="handtrap" required style="flex: 1;">
        <option value="0" <?php echo e(old('handtrap', $card->handtrap ?? 0) == 0 ? 'selected' : ''); ?>>No</option>
        <option value="1" <?php echo e(old('handtrap', $card->handtrap ?? 0) == 1 ? 'selected' : ''); ?>>Yes</option>
    </select>
</div>




<h2 style="margin-top: 20px;">Effects</h2>

<div id="effectsContainer">

<?php $effectIndex = 0; ?>

<?php $__currentLoopData = old('effects', $card->effects ?? [null]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $effect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="effect-group">
<h4>Effect <?php echo e($effectIndex + 1); ?></h4>

<label>Action</label>
<select name="effects[<?php echo e($effectIndex); ?>][action_id]" required>
    <option value="" disabled>— Select Action —</option>
    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($action->action_id); ?>"
            <?php echo e(old("effects.$effectIndex.action_id", $effect->action_id ?? null) == $action->action_id ? 'selected' : ''); ?>>
            <?php echo e($action->action_name); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<label>Activation Location</label>
<select name="effects[<?php echo e($effectIndex); ?>][activation_location_id]" required>
    <?php $__currentLoopData = $activationLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($loc->location_id); ?>"
            <?php echo e(old("effects.$effectIndex.activation_location_id", $effect->activation_location_id ?? null) == $loc->location_id ? 'selected' : ''); ?>>
            <?php echo e($loc->location_name); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<label>Target Location</label>
<select name="effects[<?php echo e($effectIndex); ?>][target_location_id]" required>
    <?php $__currentLoopData = $targetLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($loc->location_id); ?>"
            <?php echo e(old("effects.$effectIndex.target_location_id", $effect->target_location_id ?? null) == $loc->location_id ? 'selected' : ''); ?>>
            <?php echo e($loc->location_name); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<label>Target Type</label>
<select name="effects[<?php echo e($effectIndex); ?>][target_type_id]" required>
    <?php $__currentLoopData = $targetTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($type->target_type_id); ?>"
            <?php echo e(old("effects.$effectIndex.target_type_id", $effect->target_type_id ?? null) == $type->target_type_id ? 'selected' : ''); ?>>
            <?php echo e($type->target_name); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<label>Trigger</label>
<select name="effects[<?php echo e($effectIndex); ?>][trigger_id]">
    <option value="">— No Trigger —</option>
    <?php $__currentLoopData = $triggers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trigger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($trigger->trigger_id); ?>"
            <?php echo e(old("effects.$effectIndex.trigger_id", $effect->trigger_id ?? null) == $trigger->trigger_id ? 'selected' : ''); ?>>
            <?php echo e($trigger->trigger_name); ?>

        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<label>Notes</label>
<textarea name="effects[<?php echo e($effectIndex); ?>][notes]"><?php echo e(old("effects.$effectIndex.notes", $effect->notes ?? '')); ?></textarea>

<?php if($effectIndex > 0): ?>
<button type="button" class="remove-btn">Remove</button>
<?php endif; ?>
</div>

<?php $effectIndex++; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<button type="button" class="add-effect">+ Add Another Effect</button>

<br><br>
<button type="submit" class="save-btn">
    <?php echo e($isEdit ? 'Update Card + Effects' : 'Save Card + Effects'); ?>

</button>
</form>




<h2>Existing Cards</h2>

<table>
<tr>
    <th>Card</th>
    <th>Handtrap</th>
    <th>Category</th>
    <th>Effects</th>
    <th>Actions</th>
</tr>

<?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($c->card_name); ?></td>
    <td><?php echo e($c->handtrap ? 'Yes' : 'No'); ?></td>
    <td><?php echo e($c->category->category_name ?? '—'); ?></td>
    <td>
        <?php $__currentLoopData = $c->effects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div><strong><?php echo e($e->action->action_name); ?></strong></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </td>
    <td>
        <a href="<?php echo e(route('cards.edit', $c->card_id)); ?>" class="edit-btn">Edit</a>

        <form method="POST" action="<?php echo e(route('cards.destroy', $c->card_id)); ?>" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="delete-btn">Delete</button>
        </form>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<script>
let effectIndex = <?php echo e($effectIndex); ?>;
const container = document.getElementById('effectsContainer');

document.querySelector('.add-effect').addEventListener('click', () => {
    const div = document.createElement('div');
    div.className = 'effect-group';

    div.innerHTML = `
    <h4>Effect ${effectIndex + 1}</h4>
    <label>Action</label>
    <select name="effects[${effectIndex}][action_id]" required>
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($action->action_id); ?>"><?php echo e($action->action_name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="button" class="remove-btn">Remove</button>
    `;

    container.appendChild(div);
    effectIndex++;

    div.querySelector('.remove-btn').addEventListener('click', () => div.remove());
});
</script>

</body>
</html>
<?php /**PATH C:\Users\Dion Mata\Dion\lis162maindir\test3\lleapp5\resources\views/cards.blade.php ENDPATH**/ ?>