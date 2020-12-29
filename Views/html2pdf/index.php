<style type="text/css">
    page {
        background-color: #FF0000;
    }

    table {
        width: 100%;

    }
</style>

<page style="background-image: url('assets/chapeau.jpg');">
    <table>
        <tr>
            <td style="width:100%"><img src="assets/chapeau.jpg" width="400"></td>

        </tr>
        <?php foreach ($annonces as $annonce) : ?>
            <tr>

                <td><?= $annonce->titre ?></td>
            </tr>
        <?php endforeach; ?>

    </table>

</page>