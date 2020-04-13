<?php include ROOT.'/views/layouts/admin_header.php' ?>
<main class="main wrapper user-cabinet__wrapper">
    <p class="registration__header admin__product__update__header">Добавить новый товар</p>
    <form class="admin__product__update__form" method="post" enctype="multipart/form-data"  action="/admin/product/create">
        <div>
            <label class="registration__label" for="name">Наименование</label>
            <input id="name" class="registration__field contact_field" name="name">
            <label class="registration__label" for="image">Изображение</label>
            <input id="image" type="file" class="registration__field contact_field" name="image">
            <label class="registration__label" for="price">Стоимость</label>
            <input id="price" class="registration__field contact_field" type="number" step="any" name="price">
            <label class="registration__label" for="amount">Количество</label>
            <input id="amount" class="registration__field contact_field" type="number" name="amount">
            <label class="registration__label" for="short_name">Краткое наименование</label>
            <textarea id="short_name" class="registration__field contact_field" name="short_name"></textarea>
            <label class="registration__label" for="short_description">Краткое описание</label>
            <textarea id="short_description" class="registration__field contact_field" name="short_description"></textarea>
            <label class="registration__label" for="description">Подробное описание</label>
            <textarea id="description" class="registration__field contact_field" name="description"></textarea>
            <input class="registration_submit" type="submit" name="submit" value="Отправить">
        </div>
    </form>
</main>
