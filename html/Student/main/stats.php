<?php
session_start();
define('FNPATH', $_SERVER['DOCUMENT_ROOT']."/php_script/");
require_once FNPATH.'auth.php';
?>
<script type="text/javascript" src="/content/js/raphael-min.js"></script>
<script type="text/javascript" src="/content/js/student-function.js"></script>
<title>Статистика</title>
<div class="container">
    <div class="row-fluid">
        <div class="span3 truewell">
            <div class="sidebar-nav">
                <ul class="nav nav-list">
                    <li class="nav-header">Sidebar</li>
                    <li class="active"><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li class="nav-header">Sidebar</li>
                </ul>
            </div>
        </div>
        <div class="span9 truewell" style="height: 450px;">
            <h2 style=" margin: 20px 10px 40px 30px;">График популярности направлений подготовки</h2>

            <div class="span5" id="holder-web-chart"  style="height: 200px;">

            </div>
            <div class="span5">
                <h3>Направления подготовки</h3>
                <select id="select-direction">
                    <option>Пусто</option>
                </select>
                <a id="add-to-ids" href="#"><i class="icon-plus-sign"></i></a>
                <a class="btn btn-mini" id="clear-ids" href="#">Очистить</a>
                <div id="list-ids">

                </div>
            </div>
            <script>
                            //добавление в список
                        $(function(){
                            $("#clear-ids").click(function(){
                                $.cookie("list_ids",null,{path: '/'});
                                $("#list-ids").empty();
                                return false;
                            });
                            $("#add-to-ids").click(function(){

                                var cook="";
                                if($.cookie("list_ids")) {
                                    cook=$.cookie("list_ids");
                                }
                                var val=$("#select-direction option:selected").val()
                                //проверяем есть ли уже
                                var arrCook=cook.split(";");
                                if($.inArray(val,arrCook)!=-1) return false;
                                cook+=val+";";
                                $.cookie('list_ids', cook, { expires: 7, path: '/' });
                                $("#list-ids").append("<p>"+$("#select-direction option:selected").text()+"</p>");
                                var list=$("#list-ids p");
                                var cook_count=list.count;
                                if(cook_count!=null && arrCook.length>4)
                                    $.getJSON("/php_script/StudentService/get_stats.php", {type:"ch",graph:"web"}, function(json){
                                        drawWebChart(150,2,json,{"stroke-width": 0.8},
                                            {stroke:"05C","stroke-width": 2});
                                    })
                                else
                                    $.getJSON("/php_script/StudentService/get_stats.php", {type:"ch",graph:"chart"}, function(json) {
                                        $("#holder-web-chart").tufteBar({
                                            data:json,
                                            barWidth: 0.8,
                                            axisLabel: function(index) { return this[1].label }
                                        });
                                    })

                        return false;
                    });
                });

                $(function(){
                    $.getJSON("/php_script/StudentService/get_dirs.php",{},function(json) {
                        for(var j in json) {
                            j=json[j];
                        $("#select-direction").get(0).add(new Option(j['name'],j['id'],true))
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>