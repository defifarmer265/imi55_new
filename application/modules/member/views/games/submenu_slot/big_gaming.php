<style>
    .block {
        border: 1px solid red;
        text-align: center;
        vertical-align: middle;
    }

    .circle {
        border: 2px solid #FFFFFF;
        background: rgba(60, 72, 76, 1.00);
        border-radius: 200px;
        color: white;
        height: 180px;
        font-weight: bold;
        width: 180px;
        display: table;
        margin: 20px auto;
    }

    .circle p {
        vertical-align: middle;
        display: table-cell;
    }

    .square {
        border: 2px solid #FFFFFF;
        background: rgba(255, 255, 255, 0.00);
        border-radius: 200px;
        color: white;
        position: relative;
        width: 100%;

    }

    .square:after {
        vertical-align: middle;
        content: "";
        display: block;
        padding-bottom: 100%;
    }

    .content {
        vertical-align: middle;
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .img_icon {
        padding-top: 25%;
    }

    .text_icon {
        padding-top: 9%;
        font-size: 16px;
        white-space: nowrap;
    }.myimg:hover{
        transform: scale(1.2);
    }
</style>

<header class="masthead text-white text-center" style="" id="tap_contact">
    <div class="container">
        <!-- <div class="row" style="width: 100%;">
        <?php
            for ($i = 0; $i < (20); $i++) {
            ?>
                <div class="col-4 mb-2 " onclick="">
                    <div style="text-align: center;">
                        <div style="overflow: hidden;"> <img class="img-fluid myimg" src="" width="100%" class="img_icon"> </div>
                    </div>

                </div>
            <?php
            }
            ?>
        </div> -->

        <div class="row mt-4">
        <div class="col-6 mb-2 " onclick="">
                    <div style="text-align: center;">
                        <div style="overflow: hidden;"> <img class="img-fluid myimg" src="https://mem.imiwin.com/Content/images/games/bge/images/games/411.jpg?v=1596611223222" width="100%" class="img_icon"> </div>
                    </div>

                </div>
                <div class="col-6 mb-2 " onclick="">
                    <div style="text-align: center;">
                        <div style="overflow: hidden;"> <img class="img-fluid myimg" src="https://mem.imiwin.com/Content/images/games/bge/images/games/105.jpg?v=1596611223222" width="100%" class="img_icon"> </div>
                    </div>

                </div>
        </div>

<div style="padding-top: 150px;"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



    <script>
        // var dd = [];
        // $.each($('.lazyload'), function( index, value ) {
        //     dd.push($(value).data('src'));
        // });
        $.each($('.myimg'), function( index, value ) {
            // $(this).attr("src","https://mem.imiwin.com/"+dd[index]);
            // opengame('CQ9',);
            var l = $(this).attr("src").split('https://mem.imiwin.com/Content/images/games/bge/images/games/');
            var l2 = l[1].split('.jpg');
            var d = $( this ).parent( "div" ).parent( "div" ).parent( "div" );
            $(d).attr("onclick","opengame('BGE','"+l2[0]+"');");
        });
    </script>