<?php include '../../php_script/StudentService/studentService.php';
      include '../../php_script/Trans/Trans.php';
      include '../../php_script/Student/Student.php';
      
?>
<title>Результаты</title>

<div class="row span10">
    <div id="choose-info" class="span4 well">
    <h2>Вы выбрали:</h2>
    <dl>
        <?php $direction=getFullInfoDirection($_REQUEST['direction']); ?>
        <input type="hidden" id="direction-temp" value="<?= $_REQUEST['direction'] ?>"/>
        <dt>Факультет:</dt><dd id="faculty-temp-choose"><?= Faculty::getName($direction->faculty) ?></dd>
        <dt>Кафедра:</dt><dd id="cathedra-temp-choose"><?= Cathedra::getName($direction->cathedra) ?></dd>
        <dt>Направление:</dt><dd id="direction-temp-choose"><?= $direction->name." ".$direction->description ?></dd>
        <dt>Форма обучения:</dt><dd id="edu-temp-choose">
            <select id="education-form">
                <option value="1">Дневная</option>
                <option value="0">Вечерняя</option>
            </select>
        </dd>
        <dt>Примерная стоимость:</dt><dd id="cost"></dd>
    </dl>
    </div>
<div class="span3 well" id="counter">
    <h2>Это направление уже было выбрано</h2>
    <?= getCountStudentByIdDirection($direction->id) ?>
    <h2>раз</h2>
</div>

    <div id="do-choose-btn" class="span1">
        <a id="do-choose" class="btn btn-primary btn-large" rel="popover" data-content="Нажав кнопку, вы подадите заявление, которое будет рассмотрено в течении нескольких дней" data-original-title="Внимание">Выбрать</a>
    </div>
    <script>
    $(function(){
        $("#do-choose").popover();
    })
    </script>
    
</div>
<div class="row points-row">
    <div class="span7">
<h2>Оценки, на первом курсе</h2>
<div class="points">
    <?php
    $ifmodb=  connectToIfmoDb();
    $fspodb= connectToFspoDB();
    $student_id=$_COOKIE['idst'];
    $transfers = Trans::getTransfersByIdDirection($direction->id);
    $disciplines = Trans::getDisciplinesByDirection($direction->id, $ifmodb);
    $student=Student::getStudentById($student_id);
    ?>
    <div id="stud-predmet">
        <table class="table table-bordered" id="stud-subject-table">
            <thead>
                <tr>
                    <th>Предмет СПО</th>
                    <th>Оценка</th>
                    <th>Предмет ВПО</th>
                </tr>
            </thead>
            <!--Формируем таблицу дисциплин и соответствующих предметов-->
            <tbody id="stud-subject-body">
            <?php
                foreach ($disciplines as $discipline) //формируем таблицу соотсвествия предметов и дисциплин
                {
            ?>
                <tr>
                    <td><?php $subject=Trans::getSubjectByDiscipline($discipline, $fspodb, $ifmodb);echo $subject['name']; ?></td>
                    <td id="point"><?php  $point=$student->getPoint($fspodb,$subject['id']); echo $point['point']; ?></td>
                    <td><?= Trans::getDisciplineById($discipline, $ifmodb) ?></td>
                </tr>
            <?php
                } 
            ?>
            </tbody>
        </table>
    </div>
        <script>
            $(function() {
                
            })
        </script>
        <script>//красим ячейки
            $(function(){
                $("#stud-subject-body tr").each(function() {
                    var point=parseInt($(this).children("#point").html());
                    if(point<3 || isNaN(point))
                        {
                            $(this).addClass("badResult")
                            //$(this).css("background-color", "red")
                        }
                });
            });
        </script>    
</div>
</div>
<div class="span2">

</div>
</div>

                    <div id="check-dlg" class="modal fade">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal">×</a>
                            <h2>Отправка заявки</h2>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <ul>
                                    <li>
                                        ФИО:<p id="fio"></p>
                                    </li>
                                    <li>Факультет:<p id="faculty-choose"></p></li>
                                    <li>Кафедра:<p id="cathedra-choose"></p></li>
                                    <li>Направление:<p id="direction-choose"></p></li>
                                    <li>Форма обучения<p id="education-form-choose"></p></li>
                                </ul>
                            </div>   
                        </div>
                        <div class="modal-footer">
                            <a href="#" id="send-choose" class="btn btn-primary">Отправить</a>
                            <a href="#" class="btn" data-dismiss="modal">Отмена</a>
                        </div>
                    </div>
                    <script>                        
                        $(function() {
                            $("#content-nav").children("li").each(function(){
                               $(this).removeClass("current-nav"); 
                            });
                           
                            $("#content-nav #step4").addClass("current-nav");
                        });
                    </script>
                    <script>
                    //диалог отправки заявки
                    $(function(){
                        $("#do-choose").click(function(){
                            //грузим данные в диалог                            
                            $.get("/php_script/StudentService/getFio.php", {id:<?= $_SESSION['user_id'] ?>}, 
                            function(data){
                                $("#check-dlg #fio").text(data);
                            });
                            $("#faculty-choose").text($("#faculty-temp-choose").text());
                            $("#cathedra-choose").text($("#cathedra-temp-choose").text());
                            $("#direction-choose").text($("#direction-temp-choose").text());
                            $("#check-dlg").modal();
                        });
                        //отправка заявки
                        $("#send-choose").click(function(){
                            var direction=$("#direction-temp").val();
                            var edu_form=$("#education-form").val();
                            $.post("/php_script/StudentService/doChoose.php", 
                                {
                                    id_student:<?= $_SESSION['user_id'] ?>,
                                    id_direction:direction,
                                    edu_form:edu_form
                                }
                            , function(){
                                $("#check-dlg").modal('hide');
                            })
                        })
                        return false;
                    });
                    </script>
                      