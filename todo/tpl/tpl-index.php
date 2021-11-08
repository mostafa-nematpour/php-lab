<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITEL ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
  <link rel="icon" href="<?= BASE_URL ?>assets/img/t.svg">
  <title>todo</title>
</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="page">
    <div class="pageHeader">
      <div class="title">Dashboard</div>
      <div class="userPanel">

        <a href="<?= site_url("?logout=1") ?>">
          <i class="fa fa-sign-out"></i>
        </a>


        <span class="username">
          <?= getLoggedInUser()->name ?? 'Unknow' ?>
        </span>
        <img src=<?= $user->imag ?> width="40" height="40" />

      </div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div><i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
        </div>
        <div class="menu">
          <div class="title">Folders</div>
          <div>
            <input type="text" id="addFolderInput" style="width: 60%; margin-left: 3%;" placeholder="Add New Folder" />
            <button class="btn clickable" id="addFolderBtn">+</button>
          </div>
          <ul class="folder-list">
            <li class="<?= (($_GET["foler_id"]) == 0) ? 'active' : '' ?>">
              <a href="<?= site_url('?foler_id=0') ?>"><i class="fa  <?= (($_GET["foler_id"]) == 0) ? 'fa-folder-open' : 'fa-folder' ?>"></i>All</a>

            </li>

            <?php foreach ($folders as $folder) : ?>
              <li class="<?= (($_GET["foler_id"]) == $folder->id) ? 'active' : '' ?>">

                <a href="?foler_id=<?= $folder->id ?>"><i class="fa  <?= (($_GET["foler_id"]) == $folder->id) ? 'fa-folder-open' : 'fa-folder' ?>"></i><?= $folder->name ?></a>

                <a href="?delete_folder=<?= $folder->id ?>" class="remove"><i class="fa fa-trash-o" onclick="return confirm('are you sure to delete this item?');"></i></a>

              </li>
            <?php endforeach; ?>

          </ul>

        </div>


      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title" style="width: 42%;">
            <input type="text" id="taskNameInput" style="width: 100%;margin-left: 3%;line-height: 30px;" placeholder="Add New Task">
          </div>
          <div class="functions">
            <div class="button active">Add New Task</div>
            <div class="button">Completed</div>
          </div>
        </div>
        <div class="content">
          <div class="list">
            <div class="title">Today</div>
            <ul>
              <?php if (sizeof($tasks) > 0) : ?>

                <?php foreach ($tasks as $task) : ?>

                  <li class="<?= $task->is_done ? 'checked' : ''; ?>">
                    <i data-taskId="<?= $task->id ?>" class="isDone clickable fa <?= $task->is_done ? 'fa-check-square-o' : 'fa-square-o'; ?>"></i>
                    <span><?= $task->title ?></span>
                    <a href="?delete_task=<?= $task->id ?>" class="remove" onclick="return confirm('are you sure to delete this item?\n<?= $task->title ?>');"><i class="fa fa-trash-o"></i></a>

                    <div class="info">
                      <span>Created At <?= $task->created_at ?></span>
                    </div>

                  </li>

                <?php endforeach; ?>
              <?php else : ?>
                <li> No Task Here ... </li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/script.js"></script>

  <script>
    $(document).ready(function() {
      $('#taskNameInput').focus();
      $("#addFolderBtn").click(function(e) {
        var input = $('input#addFolderInput');
        // alert(input.val());
        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "addFolder",
            folderName: input.val()
          },
          success: function(response) {
            if (IsValidJSONString(response)) {
              var obj = JSON.parse(response);
              if (obj["response"] == '1') {
                $('<li> <a href="?foler_id=' + obj["id"] + '"><i class="fa fa-folder"></i>' + input.val() + '</a> <a href="?delete_folder=' + obj["id"] + '" class="remove"><i class="fa fa-trash-o"></i></a> </li>').appendTo('ul.folder-list');
              } else {
                console.log(response);
              }
            } else {
              console.log("response are not json");
            }
          }
        });
      })

      $('#taskNameInput').on('keypress', function(e) {
        e.stopPropagation();
        if (e.which == 13) {
          // alert(<?= $_GET["foler_id"] ?>);
          $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
              action: "addTask",
              folderId: "<?= $_GET["foler_id"] ?>",
              taskTitle: $('#taskNameInput').val()
            },
            success: function(response) {
              //  alert(response);
              if (IsValidJSONString(response)) {
                var obj = JSON.parse(response);
                if (obj["response"] == '1') {
                  location.reload();
                } else {
                  console.log(response);
                }
              } else {
                console.log("response are not json");
              }
            }
          });
        }
      });


      $('.isDone').click(function(e) {
        var tId = $(this).attr('data-taskId');

        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "doneSwitch",
            taskId: tId
          },
          success: function(response) {
            //  alert(response);
            if (IsValidJSONString(response)) {
              var obj = JSON.parse(response);
              if (obj["response"] == '1') {
                location.reload();
              } else {
                console.log(response);
              }
            } else {
              console.log(response);
            }
          }
        });

      });


      function IsValidJSONString(str) {
        try {
          JSON.parse(str);
        } catch (e) {
          return false;
        }
        return true;
      }
    });
  </script>
</body>

</html>