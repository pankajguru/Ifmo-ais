<?php session_start(); ?>
<script>
    $("document").ready(function(){
$("#submit-cud").click(function(){
    var form=$("#form-cud").serialize();
    $.post("/php_script/crud_fcd.php", form , function(data){
        $("#form-cud").html(data);
    });
    return false;
});
});
</script>
<?php
if (isset($_SESSION['user_id']) AND $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
{
    require 'dbconnect.php';


        if(isset($_GET['update'])) //изменение данных
        {
                if($_GET['state']=='faculty')
                {
// <editor-fold defaultstate="collapsed" desc="изменить факультет">
        $facs=mysql_query('SELECT * FROM faculty WHERE id='.mysql_escape_string($_GET['faculty']));
        if($fac = mysql_fetch_assoc($facs))
        {//форма редактирования

            echo '
                <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                   <label for="name-input">Сокращённое название</label>
                   <input type="text" id="name-input" name="name-input" value="' . $fac['name'] . '"/>
                   <label for="full-name-input">Полное название</label>
                   <input type="text" id="full-name-input" name="full-name-input" value="' . $fac['full_name'] . '"/>
                   <input type="hidden" id="faculty-h" name="faculty-h" value="' . $_GET['faculty'] . '"/>
                   <label for="dekan-input">Декан</label>
                   <input type="text" id="dekan-input" name="dekan-input" value="'.$fac['dekan'].'">
                   <label for="desc-input">Описание</label>
                   <textarea row=80 cols=45 id="desc-input" name="desc-input">'.$fac['description'].'</textarea>
                   <input type="hidden" name="update-state" value="true">
                   <input type="submit" value="ОК" id="submit-cud" name="submit"/>
                </form>
                ';
                }// </editor-fold>
                }
                elseif($_GET['state']=='cathedra')
                {
// <editor-fold defaultstate="collapsed" desc="изменить кафедру">
            $cats = mysql_query('SELECT * FROM cathedra WHERE id=' . $_GET['cathedra'] . ' AND id_faculty=' . $_GET['faculty']) or die("error");
            if ($cat = mysql_fetch_assoc($cats))         {//форма редактирования

             echo '<form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                   <label for="name-input">Сокращённое название</label>
                   <input type="text" id="name-input" name="name-input" value="' . $cat['name'] . '"/>
                   <label for="full-name-input">Название</label>
                   <input type="text" id="full-name-input" name="full-name-input" value="' . $cat['full_name'] . '"/>
                   <label for="dekan-input">Зав.кафедры</label>
                   <input type="text" id="dekan-input" name="dekan-input" value="'.$cat['dekan'].'"/>
                   <label for="url-input">Сайт кафедры</label>
                   <input type="text" id="url-input" name="url-input"/>
                   <label for="desc-input">Описание</label>
                   <textarea row=10 cols=45 id="desc-input" name="desc-input">'.$cat['description'].'</textarea>
                   <select name="link-f-c" id="link-f-c">
                   <option disable>Факультет</option>';
                $facs = mysql_query('SELECT id,name FROM faculty');
                while ($fac = mysql_fetch_assoc($facs))                     {
                    if ($fac['id'] == $_GET['faculty'])
                        echo '<option selected value=' . $fac['id'] . '>' . $fac['name'] . '</option>';
                    else
                        echo '<option value=' . $fac['id'] . '>' . $fac['name'] . '</option>';
                }


                echo '</select>
                   <input type="hidden" id="faculty-h" name="faculty-h" value="' . $_GET['faculty'] . '">
                   <input type="hidden" id="cathedra-h" name="cathedra-h" value="' . $_GET['cathedra'] . '"/>
                   <input type="hidden" name="update-state" value="true">
                   <input type="submit" value="ОК" id="submit-cud" name="submit"/>
                </form>';

        }// </editor-fold>
                }
                elseif($_GET['state']=='direction')
                {
// <editor-fold defaultstate="collapsed" desc="РёР·РјРµРЅРёС‚СЊ РЅР°РїСЂР°РІР»РµРЅРёРµ">
            $dirs = mysql_query('SELECT * FROM direction WHERE id=' . $_GET['direction']) or die("error");
            if ($dir = mysql_fetch_assoc($dirs))         {//С„РѕСЂРјР° СЂРµРґР°РєС‚РёСЂРѕРІР°РЅРёСЏ

             echo '<form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                   <label for="name-input">Название</label>
                   <input type="text" id="name-input" name="name-input" value="' . $dir['name'] . '"/>
                   <label for="full-name-input">Название</label>
                   <input type="text" id="full-name-input" name="full-name-input" value="' . $dir['description'] . '"/>
                   <select name="link-f-c" id="link-f-c">
                   <option disable>Факультет</option>';
                $facs = mysql_query('SELECT id,name FROM faculty');//РїРѕР»СѓС‡Р°РµРј С„Р°РєСѓР»СЊС‚РµС‚
                while ($fac = mysql_fetch_assoc($facs))
                {
                    if ($fac['id'] == $_GET['faculty'])
                        echo '<option selected value=' . $fac['id'] . '>' . $fac['name'] . '</option>';
                    else
                        echo '<option value=' . $fac['id'] . '>' . $fac['name'] . '</option>';
                }
                echo '</select>

                <select name="link-c-d" id="link-c-d">
                <option disable>Кафедра</option>';
                $cats = mysql_query('SELECT id,name FROM cathedra');//РїРѕР»СѓС‡Р°РµРј РєР°С„РµРґСЂС‹
                while ($cat = mysql_fetch_assoc($cats))
                {
                    if ($cat['id'] == $_GET['faculty'])
                        echo '<option selected value=' . $cat['id'] . '>' . $cat['name'] . '</option>';
                    else
                        echo '<option value=' . $cat['id'] . '>' . $cat['name'] . '</option>';
                }
                echo '</select>

                   <input type="hidden" id="faculty-h" name="faculty-h" value="' . $_GET['faculty'] . '">
                   <input type="hidden" id="cathedra-h" name="cathedra-h" value="' . $_GET['cathedra'] . '"/>
                   <input type="hidden" id="direction-h" name="direction-h" value="' . $_GET['direction'] . '"/>
                   <input type="hidden" name="update-state" value="true">
                   <input type="submit" value="ОК" id="submit-cud" name="submit"/>
                </form>';

        }// </editor-fold>
                }
        }
        if(isset($_GET['create']))
        {
                if($_GET['state']=='faculty')
                {
// <editor-fold defaultstate="collapsed" desc="создать факультет">
                ?>
                <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                   <label for="name-input">Сокращённое название</label>
                   <input type="text" id="name-input" name="name-input">
                   <label for="full-name-input">Название</label>
                   <input type="text" id="full-name-input" name="full-name-input">
                   <label for="dekan-input">Декан</label>
                   <input type="text" id="dekan-input" name="dekan-input">
                   <label for="desc-input">Описание</label>
                   <textarea row=40 cols=80 id="desc-input" name="desc-input"></textarea>
                   <input type="hidden" id="faculty-h" name="faculty-h" value="true"/>
                   <input type="hidden" name="create-state" value="true">
                   <input type="submit" value="ОК" id="submit-cud" name="submit"/>
                </form>
                <?php
                }
                elseif($_GET['state']=='cathedra')
                {
// <editor-fold defaultstate="collapsed" desc="создать кафедру">
            ?>
                <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                   <label for="name-input">Сокращённое название</label>
                   <input type="text" id="name-input" name="name-input"/>
                   <label for="full-name-input">Название</label>
                   <input type="text" id="full-name-input" name="full-name-input"/>
                   <label for="dekan-input">Зав.кафедры</label>
                   <input type="text" id="dekan-input" name="dekan-input"/>
                   <label for="url-input">Сайт кафедры</label>
                   <input type="text" id="url-input" name="url-input"/>
                   <label for="desc-input">Описание</label>
                   <textarea row=10 cols=45 id="desc-input" name="desc-input"></textarea>
                   <input type="hidden" id="faculty-h" name="faculty-h" value="<?=$_GET['faculty']?>"/>
                   <input type="hidden" id="cathedra-h" name="cathedra-h" value="true"/>
                   <input type="hidden" name="create-state" value="true"/>
                   <input type="submit" value="ОК" id="submit-cud" name="submit"/>
                </form>
             <?php
                 // </editor-fold>
                }
                elseif($_GET['state']=='direction')
                {
        // <editor-fold defaultstate="collapsed" desc="Создание направления">
                   ?>
                <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                   <label for="name-input">Номер</label>
                   <input type="text" id="name-input" name="name-input"/>
                   <label for="full-name-input">Название</label>
                   <input type="text" id="full-name-input" name="full-name-input"/>
                   <label for="price-input">Стоимость</label>
                   <input type="text" id="price-input" name="price-input"/>
                   <input type="hidden" id="faculty-h" name="faculty-h" value="' .$_GET['faculty'] .'"/>
                   <input type="hidden" id="cathedra-h" name="cathedra-h" value="<?= $_GET['cathedra'] ?>"/>
                   <input type="hidden" id="direction-h" name="direction-h" value="true"/>
                   <input type="hidden" name="create-state" value="true">
                   <input type="submit" value="ОК" id="submit-cud" name="submit"/>
                </form>
                <?php
                 // </editor-fold>
                                }
        }
        if(isset($_GET['delete']))
        {
                if($_GET['state']=='faculty')
                {
// <editor-fold defaultstate="collapsed" desc="удалить факультет">
            echo '
                 <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                 <input type="hidden" id="faculty-h" name="faculty-h" value="' . $_GET['faculty'] . '">
                 <input type="hidden" name="delete-state" value="true">
                 <input type="submit" value="Удалить" id="submit-cud" name="submit"/>
                 </form>
                '; // </editor-fold>
                }
                elseif($_GET['state']=='cathedra')
                {
// <editor-fold defaultstate="collapsed" desc="удалить кафедру">
            echo '
                 <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                 <input type="hidden" id="faculty-h" name="faculty-h" value="' . $_GET['faculty'] . '">
                 <input type="hidden" id="cathedra-h" name="cathedra-h" value="' . $_GET['cathedra'] . '">
                 <input type="hidden" name="delete-state" value="true">
                 <input type="submit" value="Удалить" id="submit-cud" name="submit"/>
                 </form>
                '; // </editor-fold>
                }
                elseif($_GET['state']=='direction')
                {
 // <editor-fold defaultstate="collapsed" desc="удалить направление">
            echo '
                 <form method="POST" name="form-cud" id="form-cud" action="php_script/crud_fcd.php">
                 <input type="hidden" id="faculty-h" name="faculty-h" value="' . $_GET['faculty'] . '">
                 <input type="hidden" id="cathedra-h" name="cathedra-h" value="' . $_GET['cathedra'] . '">
                 <input type="hidden" id="direction-h" name="direction-h" value="' . $_GET['direction'] . '">
                 <input type="hidden" name="delete-state" value="true">
                 <input type="submit" value="Удалить" id="submit-cud" name="submit"/>
                 </form>
                '; // </editor-fold>
                }
        }
}
else
{
header("Location: http://".$_SERVER['HTTP_HOST']."/");
}
?>
