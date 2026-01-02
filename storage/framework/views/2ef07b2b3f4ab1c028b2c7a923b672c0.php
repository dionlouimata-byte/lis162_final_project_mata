<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Engine Summary</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>

<body style="background-color:#1e3a5f; padding: 20px; font-family: sans-serif;">

<div style="max-width:1200px; margin:0 auto; background:#ffffff; padding:30px; border-radius:12px; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">

    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #e5e7eb; padding-bottom: 15px;">

        <h1 style="font-size:28px; font-weight:bold; color:#1e293b; margin:0;">
            Interaction Summary
        </h1>

        <div style="display: flex; gap: 10px;">
            <a href="<?php echo e(url('/')); ?>"
               style="padding:10px 20px; background:#2563eb; color:white; text-decoration:none; border-radius:6px; font-weight:500;">
                Home
            </a>

            <a href="<?php echo e(route('compare')); ?>"
               style="padding:10px 20px; background:#64748b; color:white; text-decoration:none; border-radius:6px; font-weight:500;">
                ← Change Selection
            </a>
        </div>

    </div>

    <div style="display: flex; gap: 40px; align-items: flex-start;">

        
        <div style="flex: 1;">
            <h2 style="font-size:20px; font-weight:bold; color:#2563eb; margin-bottom:20px; text-transform: uppercase; letter-spacing: 1px;">
                Selected Engine
            </h2>

            <?php if($selectedCards->isEmpty()): ?>
                <p style="color:#64748b; font-style: italic;">No cards selected.</p>
            <?php else: ?>
                <?php $__currentLoopData = $selectedCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="margin-bottom: 25px; padding: 20px; border: 2px solid #e2e8f0; border-radius: 10px; background: #fff;">

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                            <strong style="font-size: 18px; color: #0f172a;">
                                <?php echo e($card->card_name); ?>

                            </strong>
                            <span style="font-size: 11px; background: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 20px; font-weight: bold; text-transform: uppercase;">
                                <?php echo e($card->category?->category_name ?? 'N/A'); ?>

                            </span>
                        </div>

                        
                        <?php $__currentLoopData = $card->effects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $effect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="background: #f8fafc; padding: 12px; border-radius: 8px; margin-top: 10px; border-left: 4px solid #3b82f6;">

                                <div style="font-size: 14px; color: #334155;">
                                    <span style="font-weight: 600;">Action:</span>
                                    <?php echo e($effect->action?->action_name ?? 'N/A'); ?>

                                </div>

                                <div style="font-size: 14px; color: #334155;">
                                    <span style="font-weight: 600;">Activates In:</span>
                                    <?php echo e($effect->activationLocations->first()?->location_name ?? 'Any'); ?>

                                </div>

                                <?php if(!empty($effect->notes)): ?>
                                    <div style="margin-top: 6px; font-size: 12px; color: #64748b; font-style: italic;">
                                        <?php echo e($effect->notes); ?>

                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        
        <div style="flex: 1; background: #f1f5f9; padding: 25px; border-radius: 12px; border: 1px solid #cbd5e1;">
            <h2 style="font-size:20px; font-weight:bold; color:#dc2626; margin-bottom:20px; text-transform: uppercase; letter-spacing: 1px;">
                Handtrap Library
            </h2>

            <div style="max-height: 600px; overflow-y: auto; padding-right: 10px;">
                <div style="display: grid; grid-template-columns: 1fr; gap: 12px;">

                    <?php $__currentLoopData = $counters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="background: white; padding: 15px; border-radius: 8px; border: 1px solid #fecaca;">

                            <div style="font-weight: bold; color: #991b1b; border-bottom: 1px solid #fee2e2; padding-bottom: 5px; margin-bottom: 8px;">
                                <?php echo e($counter->card_name); ?>

                            </div>

                            <?php $__currentLoopData = $counter->effects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $htEffect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                
                                <?php $__currentLoopData = $htEffect->triggerActions->unique('action_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="font-size: 12px; color: #7f1d1d; margin-top: 5px;">
                                        <span style="opacity: 0.7;">Counters:</span>
                                        <strong><?php echo e($action->action_name ?? 'Any Action'); ?></strong>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                <?php if($htEffect->targetTypes->isNotEmpty()): ?>
                                    <div style="font-size: 12px; color: #7f1d1d; margin-left: 10px;">
                                        <span style="opacity: 0.7;">Target Type:</span>
                                        <?php echo e($htEffect->targetTypes
                                            ->unique('target_type_id')
                                            ->pluck('target_name')
                                            ->join(', ')); ?>

                                    </div>
                                <?php endif; ?>

                                
                                <?php if($htEffect->targetLocations->isNotEmpty()): ?>
                                    <div style="font-size: 12px; color: #7f1d1d; margin-left: 10px;">
                                        <span style="opacity: 0.7;">Target Location:</span>
                                        <?php echo e($htEffect->targetLocations
                                            ->unique('location_id')
                                            ->pluck('location_name')
                                            ->join(', ')); ?>

                                    </div>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

            <p style="font-size: 12px; color: #64748b; margin-top: 20px; text-align: center;">
                <em>Note: Compare the "Action" on the left with the library on the right to find the best counter.</em>
            </p>
        </div>

    </div>
</div>

</body>
</html>
<?php /**PATH C:\Users\Dion Mata\Dion\lis162maindir\test3\lleapp5\resources\views/summary.blade.php ENDPATH**/ ?>