<?php
include '../model/Class_methods.php';

$model = new Class_methods();
$posts = $model->get_post($_POST["id"]);
$posts = json_decode($posts, true);

if (empty($posts)){
    echo '
<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ответ сервера</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Сервер не отвечает, пожалуста, подождите некоторое время и попробуйте снова.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
';
    exit;
}

echo '
<div class="form-block edit-post show">
            <!-- HTML-форма, оформленная с помощью стилей Bootstrap 4 -->
            <form method="post" onsubmit="return edit_post()" autocomplete="off">
                <div class="row"> 
                    <div class="col-md-12">
                        <h2 class="text-center">Изменить пост</h2>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" placeholder="Заголовок поста" value="'.$posts["title"].'" required>
                        </div>
                        <div class="form-group">
                            <input type="textarea" class="form-control" id="content" placeholder="Контент" value="'.$posts["content"].'" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="author" placeholder="Автор поста" value="'.$posts["author"].'" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="excerpt" placeholder="Краткая информация о посте" value="'.$posts["excerpt"].'" >
                        </div>
                        <div class="btn-group">
                            <select id="status" value="'.$posts["status"].'">
                                <option disabled>Статус поста</option>
                                <option value="publish">publish</option>
                                <option value="private">private</option>
                           </select
                        </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-offset-2 right">

                        <div class="form-group">
                            <input type="number" step="1" min="0" class="form-control" id="postParent" placeholder="ID поста родителя" value="'.$posts["postParent"].'" >
                        </div>
                        <div class="form-group">
                            <input type="url" class="form-control" id="url" placeholder="Ссылка на пост" required value="'.$posts["url"].'" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="thumbnailUrl" placeholder="Ссылка на картинку" value="'.$posts["thumbnailUrl"].'" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="postType" placeholder="Тип поста"value="'.$posts["postType"].'"  >
                        </div>
                        <div class="form-group">
                            <button select="'.$posts["id"].'">Изменить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
';