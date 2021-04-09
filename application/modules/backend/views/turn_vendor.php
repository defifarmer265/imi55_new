<!-- <link href="<?php echo $this->config->item('tem_frontend_css'); ?>custom.min_selectpaket.css" rel="stylesheet"> -->

<script src="<?php echo $this->config->item('tem_frontend_css'); ?>jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<!-- page content -->
<!--<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">-->

<style type="text/css">
    .text {
        color: red;
        font-size: 16px;
        padding-left: 20px;
    }

    .text:hover {
        background-color: yellow;
    }

    #cover-spin {
        position: fixed;
        width: 100%;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        display: none;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #cover-spin::after {
        content: '';
        display: block;
        position: absolute;
        left: 48%;
        top: 40%;
        width: 40px;
        height: 40px;
        border-style: solid;
        border-color: black;
        border-top-color: transparent;
        border-width: 4px;
        border-radius: 50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }

    .lds-dual-ring {}

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 30px;
        height: 30px;
        padding-bottom: -20px;
        border-radius: 50%;
        border: 6px solid #000;
        border-color: #000 transparent #000 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div id="cover-spin"></div>
<div class="right_col" role="main">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="color:#000">ประวัติการเล่นรวมตาม vendors<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_content">
                        <div class="row ">
                            <div class="col-sm-2 ">
                                วันเริ่ม
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-2">
                                วันสิ้นสุด
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                                <input type="text" class="form-control has-feedback-left" id="single_cal3" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-2">
                                <br>
                                <button type="button" onClick="find_vendor()" class="btn btn-info">ค้นหา</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="t_all" class="table table-striped table-bordered nowrap" cellspacing="0" style="font-size: 14px;width: 100%">
                                        <thead style="background-color: #2a3f54;color: #fff;">
                                            <tr class="text-center">
                                                <th width="4%">No</th>
                                                <th class="text-center">เกมส์</th>
                                                <th class="text-center">ยอดเดิมพันรวม</th>
                                            </tr>
                                        </thead>
                                        <tbody id="turn_vendor"> </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<script>
 
</script>