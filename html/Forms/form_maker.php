<?php
require '../../php_script/auth.php';
include_once '../../php_script/function.php';
    ?>
    <!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link type="text/css" rel="stylesheet" href="/content/css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="/content/css/bootstrap-responsive.min.css">
        <link type="text/css" rel="stylesheet" href="/content/css/main.css">
        <link type="text/css" rel="stylesheet" href="/content/flexigrid.css">
        <script type="text/javascript" src="/content/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/content/js/jquery.chainedSelects.js"></script>
        <script type="text/javascript" src="/content/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="/content/js/flexigrid.pack.js"></script>
        <script type="text/javascript" src="/content/js/jquery.pjax.js"></script>
        <script type="text/javascript" src="/content/js/bootstrap-alert.js"></script>
        <script type="text/javascript" src="/content/js/admin-function.js"></script>
    </head>
    <body>
        <?php include ('../header-menu.php'); ?>
        <!-- end header menu -->
        <!-- main content -->
        <div class="container">
            <div class="span12" id="content">
                <h1>Работа со студентами</h1>
                <div class="row row-content">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                            <ul class="nav nav-list">
                                <li class="active">
                                    <a href=""><i class="icon-file icon-white"></i>Студенты</a>
                                </li>
                                <li>
                                    <a href="/html/Forms/inbox.php"><i class="icon-inbox"></i>Заявки <?php include 'get_inbox_choose.php'; ?></a>
                                </li>
                                <li>
                                    <a href="ifmo_studs.php"><i class="icon-th-list"></i> Поступившие студенты</a>
                                </li>
                                <li class="nav-header">Отображать записи</li>
                                <li class="span3 well" id="filter-studs-table" style="width: 200px; margin-top:9px;">
                                    <form class="nform">
                                    <label for="year-sel">Год</label>
                                    <select id="year-sel" name="year-sel" class="span4">
                                    </select>
                                    <label for="group-sel">Группа</label>
                                    <select id="group-sel" name="group-sel" class="span4">
                                        <option value="all">Все</option>
                                            <!-- Грузим группы скриптом -->
                                    </select>
                                    <label class="checkbox">
                   <input type="checkbox" id="only-choosed" name="only-choosed"/>Выбравшие ВПО
                                    </label>
                                </form>
                                    <div class="nav-header"><i class="icon-book"></i>Документы</div>
                                    <div>
                                        <ul class="nav nav-list">
                                            <li>
                                                <a id="form-options-link">Выписка</a>
                                                <div id="form-options">
                                                    <label class="checkbox">
                                                        <input type="checkbox" id="forall"/>Для всех студентов
                                                    </label>


                                                    <a id="form-link" class="btn btn-small btn-primary">Загрузить</a>
                                                </div>
                                            </li>
                                            <li>
                                                <a id="extract-options-link">Согласование</a>
                                                <div id="extract-options">
                                                    <a id="extract-link" class="btn btn-small btn-primary">Загрузить</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                </ul>
                            </div>

                            <div class="span6">
                                <div id="fcd-content">
                                <div id="studs-container">
                                    <div class="studs-table" id="studs-table">

                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  <script type="text/javascript">
    $(function(){
      // pjax
$.hash = '#!/';
$.siteurl = '<?php echo $_SERVER['HTTP_HOST']; ?>';
$.container = '#studs-container';
      $('#studs-table a').pjax('#studs-container');//аякс запрос студента по ид
    })
  </script>
  <script>
      $(function() {//грузим список групп
          $.getJSON("/php_script/Forms/get_groups.php", {}, function(json) {
              for(var id in json) {
                  if(json[id]!="0")$("#group-sel").append("<option value="+json[id]+">"+json[id]+"</option>");
              }
          })
      });
  </script>
  <script>
      //выводим опции формы
      $(function() {
          $("#form-options-link").click(function() {
              $(this).addClass("active");
              $("#form-options").slideToggle("normal", function() {
          })
          })
          $("#extract-options-link").click(function() {
              $(this).addClass("active");
              $("#extract-options").slideToggle("normal", function() {
          })
          })
      });
  </script>


        <script>
        var params="";//параметр запроса студентов в таблице
        //по изменению значения в фильтре изменяется параметр запроса
        var arr_params=[];

    function applyParams() {
        var amper="";
        params="";
      for(var key in arr_params) {
         params+=amper+key+"="+arr_params[key];
         amper="&";
      }
      $("div#studs-table").flexOptions({url:"/php_script/Student/get_students.php?"+params});
      $("div#studs-table").flexReload();
    }
        $(function(){
            $("#filter-studs-table #only-choosed").change(function(){
                if($("#filter-studs-table #only-choosed").is(':checked'))
                                                                          arr_params['params']="choosed_direction";
                else
                    arr_params['params']="all";
                applyParams();
            });

          $("#filter-studs-table #group-sel").change(function() {
             var val=$("#group-sel").val();
             if(val!="all")
                arr_params['group']=val;
             else arr_params['group']="all"
             applyParams();
          })
        });


        $(function(){
       $("div#studs-table").flexigrid({ //Таблица студентов
           url:'/php_script/Student/get_students.php?'+params,
           dataType: 'json',
           colModel : [

                        {display: 'ФИО', name : 'name', width : 250, sortable : true, align: 'left'},
                        {display: 'Группа', name : 'group', width : 50, sortable : true, align: 'left'},
                        {display: 'Программа', name : 'programm', width : 150, sortable : true, align: 'left'}

           ],
           buttons : [
               {name: '<i class="icon-check"></i>Поступил на ВПО', bclass: 'create', onpress : doCommand}
           ],

           searchitems : [
                        {display: 'ФИО', name : 'name'}
                ],
                sortname: "Familia",
                sortorder: "asc",
                usepager: false,
                title: "Студенты",
                useRp: false,
                rp: 300,
                showToggleBtn:false,
                showTableToggleBtn: false,
                resizable: false,
                width: 600,
                height: 400,
                singleSelect: false,
                minwidth:200
       });
    });

//Кнопки таблицы
    function doCommand(com, grid) {
            if (com == '<i class="icon-check"></i>Поступил на ВПО') {
            $('.trSelected', grid).each(function() {
            var id = $(this).attr('id');
                if(id==null) return false;
            id = id.substring(id.lastIndexOf('row')+3);
                        $.get("/php_script/Forms/ifmo_studs.php",{id:id,state_ifmo:"1"},
                            function(data)
                            {
                                $("div#studs-table").flexReload();
                                createAutoClosingAlert("#alert-save",2000);
                            });

            });
            }
            }
            $(function() {
                $("#form-link").click(function() {
                    var data="";
                    if($("#forall").is(":checked")) {
                        data="all";
                    }
                    else {
                    $('.trSelected').each(function() {
                        var id = $(this).attr('id');
                        id = id.substring(id.lastIndexOf('row')+3);
                        data+=id+";";
                    });
                    }

    document.location.href="/php_script/Forms/Form_docxgen/form_creator.php?form=form&type=archive&ids="+data;
                })
            });

            $(function() {
                $("#extract-link").click(function() {
                    var data="";
                    if($("#forall").is(":checked")) {
                        data="all";
                    }
                    else {
                    $('.trSelected').each(function() {
                        var id = $(this).attr('id');
                        id = id.substring(id.lastIndexOf('row')+3);
                        data+=id+";";
                    });
                    }
            document.location.href="/php_script/Forms/Form_docxgen/form_creator.php?form=extract&type=archive&ids="+data;

            });
            });
        </script>

    </body>
</html>
