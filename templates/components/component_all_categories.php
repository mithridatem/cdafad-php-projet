<select name="categories[]" multiple>
    <?php foreach ($data as $category) : ?>
        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
    <?php endforeach ?>
</select>