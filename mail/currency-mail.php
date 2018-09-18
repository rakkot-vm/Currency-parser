<table>
    <thead>
        <tr>
            <th>Валюта</th>
            <th>Покупка</th>
            <th>Продажа</th>
            <th>Межбанк</th>
            <th>НБУ</th>
        </tr>
    </thead>
    <tbody>

    <?php
    foreach ($currencyValues as $value):?>
    <tr>
        <td><?= $value->currency->title; ?></td>
        <td><?= $value->purchase;?></td>
        <td><?= $value->sale;?></td>
        <td><?= $value->interbank;?></td>
        <td><?= $value->nbu;?></td>
    </tr>
    <?php endforeach;?>

    </tbody>
</table>