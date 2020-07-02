<? include VIEW_PATH."/include/_header.php"; ?>

<link rel="stylesheet" href="/css/bootstrap-table.min.css">
<link rel="stylesheet" href="/css/all.min.css">

<body class="bg-light">

<? include VIEW_PATH."/include/_nav.php"; ?>

<? include VIEW_PATH."/admin/user/_sub_nav.php"; ?>

<main role="main" class="container-fluid">
    <div class="p-3 bg-white rounded shadow-sm">
        <h6 class="pb-2 mb-0">搜尋條件</h6>
        <form class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" id="SearchInputName" placeholder="會員名稱" value="" required>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" class="form-control" id="SearchInputAccount" placeholder="會員帳號" value="" required>
                </div>
<!--                <div class="col-md-3 mb-3">-->
<!--                    <select id="inputState" class="form-control">-->
<!--                        <option selected>帳號排序</option>-->
<!--                        <option>創建帳號日期</option>-->
<!--                        <option>創建帳號日期(反向)</option>-->
<!--                    </select>-->
<!--                </div>-->
                <div class="col-md-3 mb-3">
                    <button class="btn btn-primary btn-block" type="button" onclick="$('#table').bootstrapTable('refresh');">搜尋</button>
                </div>
            </div>
        </form>
        <h5 class="pb-2 mb-0">會員列表</h5>
        <table id="table" class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="name" data-sortable="true">名稱</th>
                    <th data-field="account" data-sortable="true">帳號</th>
                    <th data-field="phone" data-sortable="true">電話</th>
                    <th data-field="email" data-sortable="true">Email</th>
                    <th data-field="intro" data-sortable="true">介紹人</th>
                    <th data-field="new_time" data-sortable="true">創建日期</th>
                    <th data-field="operation" data-formatter="operateFormatter">操作</th>
                </tr>
            </thead>
        </table>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalTitle">彈出視窗主題</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div id="detailModalBody" class="modal-body">

                        <div class="form-group">
                            <label for="InputName">名稱</label>
                            <input type="text" class="form-control" id="InputName">
                        </div>
                        <div class="form-group">
                            <label for="InputAccount">帳號</label>
                            <input type="text" class="form-control" id="InputAccount">
                        </div>
                        <div class="form-group">
                            <label for="InputPhone">電話</label>
                            <input type="text" class="form-control" id="InputPhone">
                        </div>
                        <div class="form-group">
                            <label for="InputEmail">email</label>
                            <input type="email" class="form-control" id="InputEmail">
                        </div>
                        <div class="form-group">
                            <label for="InputIntro">介紹人</label>
                            <input type="text" class="form-control" id="InputIntro">
                        </div>
                        <div class="form-group">
                            <label for="InputNewTime">創建日期</label>
                            <input type="text" class="form-control" id="InputNewTime" readonly>
                        </div>
<!--                        <button type="submit" class="btn btn-primary">Submit</button>-->
                    <input type="hidden" class="form-control" id="InputID" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="sendModelData()">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>

<? include VIEW_PATH."/include/_js_src.php"; ?>

<script src="/js/bootstrap-table.min.js"></script>
<script src="/js/tableExport.min.js"></script>
<script src="/js/bootstrap-table-export.min.js"></script>

<script>
    $('#table').bootstrapTable({
        showFullscreen:true,//開啟全版功能
        showExport:'true',//開啟匯出功能
        exportTypes: ['csv', 'txt', 'excel'],//匯出功能設定
        showColumns:'true',//開啟欄位開關功能
        url:'/user/data',
        method: 'post',
        pagination: "server",//開啟分頁功能
        pageSize: 15,//一頁幾筆
        pageList: [5, 10, 15, 20],//修改一頁幾筆
        sidePagination:"server",//使用server端分頁
        queryParams:"queryParams",//增加分頁額外參數設定
    });
    //query參數傳遞
    function queryParams(params) {
        //設定額外參數
        params.SearchInputName = $('#SearchInputName').val();//搜尋名稱
        params.SearchInputAccount = $('#SearchInputAccount').val();//搜尋帳號
        return params ;
    }
    //開啟modal
    function openModal(id){
        //ajax抓資料
        $.ajax({
            type: 'GET',
            url: '/user/update/'+id,
            beforeSend:function(){
                var data = "loading...";
                //更新modal資料
                $('#InputName').val(data);
                $('#InputAccount').val(data);
                $('#InputPhone').val(data);
                $('#InputEmail').val(data);
                $('#InputIntro').val(data);
                $('#InputNewTime').val(data);
                $('#InputID').val(data);
                //更新modal資料
                $('#detailModalTitle').html(data);
            },
            success: function(data) {
                console.log(data);
                //更新modal資料
                $('#InputName').val(data.name);
                $('#InputAccount').val(data.account);
                $('#InputPhone').val(data.phone);
                $('#InputEmail').val(data.email);
                $('#InputIntro').val(data.intro);
                $('#InputNewTime').val(data.new_time);
                $('#InputID').val(data.id);
                //更新modal資料
                $('#detailModalTitle').html("會員:"+data.name);
                //JS方式開啟modal
                $('#detailModal').modal('show');
            }
        });

    }
    //modal資料更新、關閉modal
    function sendModelData() {
        //ajax更新資料
        var data = {};
        data.name = $('#InputName').val();
        data.account = $('#InputAccount').val();
        data.phone = $('#InputPhone').val();
        data.email = $('#InputEmail').val();
        data.intro = $('#InputIntro').val();
        data.new_time = $('#InputNewTime').val();
        data.id = $('#InputID').val();
        $.ajax({
            type: 'POST',
            url: '/user/update/',
            data: JSON.stringify(data),
            dataType: 'json',
            format:'json',
            contentType: 'application/json; charset=UTF-8',
            success: function(data) {
                console.log(data);
            }
        });
        //JS方式開啟modal
        $('#detailModal').modal('hide');
        //表格重新加載數據
        $('#table').bootstrapTable('refresh');
    }
    //操作的內容
    function operateFormatter(value,row) {
        return "<button type='button' class='btn btn-primary btn-sm' onclick='openModal("+row.id+")'>修改</button>";
    }
    //新增
    function insertModal() {
        var data = "";
        //更新modal資料
        $('#InputName').val(data);
        $('#InputAccount').val(data);
        $('#InputPhone').val(data);
        $('#InputEmail').val(data);
        $('#InputIntro').val(data);
        $('#InputNewTime').val(data);
        $('#InputID').val(data);
        //更新modal資料
        $('#detailModalTitle').html("新增會員");
        //JS方式開啟modal
        $('#detailModal').modal('show');
    }

</script>

<? include VIEW_PATH."/include/_footer.php"; ?>