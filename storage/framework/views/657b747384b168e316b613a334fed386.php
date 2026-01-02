<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compare Cards</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
</head>

<body style="background-color:#03ad7aff;">

<div style="max-width:1100px; margin:40px auto; background:#ffffff; padding:20px; border-radius:8px;">

    
    <a href="/"
       style="display:inline-block; margin-bottom:15px; padding:8px 16px; background:#2563eb; color:white; text-decoration:none; border-radius:6px; font-weight:500;">
        ← Return to Home
    </a>

    <h1 style="font-size:28px; font-weight:bold; margin-bottom:20px; color:black;">
        Compare Cards
    </h1>

    <div style="display:flex; gap:40px;">

        
        <div>
            <label style="font-weight:bold; color:black;">Select cards:</label><br>

            <select id="cardSelect" multiple size="14"
                    style="width:300px; padding:6px; color:black;">
                <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($card->card_id); ?>">
                        <?php echo e($card->card_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <div style="margin-top:15px; display:flex; gap:10px;">
                <button type="button" id="chooseBtn"
                        style="padding:8px 16px; background:#2563eb; color:white; border:none; border-radius:4px;">
                    Choose
                </button>

                <button type="button" id="clearBtn"
                        style="padding:8px 16px; background:#dc2626; color:white; border:none; border-radius:4px;">
                    Clear
                </button>
            </div>
        </div>

        
        <div style="flex:1;">
            <h2 style="font-size:18px; font-weight:bold; color:black; margin-bottom:10px;">
                Selected cards so far
            </h2>

            <table border="1" cellpadding="8" cellspacing="0"
                   style="width:100%; border-collapse:collapse; color:black;">
                <thead style="background:#e5e7eb;">
                    <tr>
                        <th align="left">Card</th>
                        <th width="80">Action</th>
                    </tr>
                </thead>
                <tbody id="chosenCardsTable">
                    <tr>
                        <td colspan="2" style="color:#6b7280;">No cards chosen</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    
    <form method="POST" action="/summary" id="summaryForm" style="margin-top:30px;">
        <?php echo csrf_field(); ?>
        <div id="hiddenInputs"></div>

        <button type="submit"
                style="padding:10px 20px; background:#16a34a; color:white; border:none; border-radius:6px;">
            Go to Summary
        </button>
    </form>

</div>

<script>
    const select = document.getElementById('cardSelect');
    const chooseBtn = document.getElementById('chooseBtn');
    const clearBtn = document.getElementById('clearBtn');
    const tableBody = document.getElementById('chosenCardsTable');
    const hiddenInputs = document.getElementById('hiddenInputs');

    const chosenCards = new Map();

    function renderTable() {
        tableBody.innerHTML = '';
        hiddenInputs.innerHTML = '';

        if (chosenCards.size === 0) {
            tableBody.innerHTML =
                '<tr><td colspan="2" style="color:#6b7280;">No cards chosen</td></tr>';
            return;
        }

        chosenCards.forEach((name, id) => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${name}</td>
                <td>
                    <button type="button"
                        data-id="${id}"
                        style="background:#dc2626;color:white;border:none;padding:4px 8px;border-radius:4px;">
                        Remove
                    </button>
                </td>
            `;

            tableBody.appendChild(row);

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'cards[]';
            input.value = id;
            hiddenInputs.appendChild(input);
        });
    }

    chooseBtn.addEventListener('click', () => {
        Array.from(select.selectedOptions).forEach(option => {
            if (!chosenCards.has(option.value)) {
                chosenCards.set(option.value, option.text);
            }
        });
        renderTable();
    });

    clearBtn.addEventListener('click', () => {
        chosenCards.clear();
        select.selectedIndex = -1;
        renderTable();
    });

    tableBody.addEventListener('click', (e) => {
        if (e.target.tagName === 'BUTTON') {
            chosenCards.delete(e.target.dataset.id);
            renderTable();
        }
    });
</script>

</body>
</html>
<?php /**PATH C:\Users\Dion Mata\Dion\lis162maindir\test3\lleapp5\resources\views/compare.blade.php ENDPATH**/ ?>