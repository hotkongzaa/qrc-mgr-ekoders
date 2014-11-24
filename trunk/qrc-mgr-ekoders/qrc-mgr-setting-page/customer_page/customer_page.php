<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="keywords" content="jquery,ui,easy,easyui,web">
        <meta name="description" content="easyui help you build your web page easily!">
        <title>QRC_BUILDING_CONFIGURATION</title>
        <link rel="stylesheet" type="text/css" href="../css/easyui.css">
        <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
        <!--<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">-->
        <style type="text/css">
            #fm{
                margin:0;
                padding:10px 30px;
            }
            .ftitle{
                font-size:14px;
                font-weight:bold;
                color:#666;
                padding:5px 0;
                margin-bottom:10px;
                border-bottom:1px solid #ccc;
            }
            .fitem{
                margin-bottom:5px;
            }
            .fitem label{
                display:inline-block;
                width:80px;
            }
            *{
                font-size:12px;
            }
            body {
                font-family:verdana,helvetica,arial,sans-serif;
                padding:20px;
                font-size:12px;
                margin:0;
            }
            h2 {
                font-size:18px;
                font-weight:bold;
                margin:0;
                margin-bottom:15px;
            }
            .demo-info{
                padding:0 0 12px 0;
            }
            .demo-tip{
                display:none;
            }
        </style>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript" src="../js/jquery.easyui.min.js"></script>
        <script type="text/javascript">
            var url;
            function newUser() {
                $('#dlg').dialog('open').dialog('setTitle', 'New Customer');
                $('#fm').form('clear');
                url = 'save_customer.php';
            }
            function editUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $('#dlg').dialog('open').dialog('setTitle', 'Edit Customer');
                    $('#fm').form('load', row);
                    url = 'update_customer.php?id=' + row.customer_id;
                }
            }
            function saveUser() {
                $('#fm').form('submit', {
                    url: url,
                    onSubmit: function() {
                        return $(this).form('validate');
                    },
                    success: function(result) {
                        var result = eval('(' + result + ')');
                        if (result.success) {
                            $('#dlg').dialog('close');		// close the dialog
                            $('#dg').datagrid('reload');	// reload the user data
                        } else {
                            $.messager.show({
                                title: 'Error',
                                msg: result.msg
                            });
                        }
                    }
                });
            }
            function removeUser() {
                var row = $('#dg').datagrid('getSelected');
                if (row) {
                    $.messager.confirm('Confirm', 'Are you sure you want to remove this customer?', function(r) {
                        if (r) {
                            $.post('remove_customer.php', {id: row.customer_id}, function(result) {
                                if (result.success) {
                                    $('#dg').datagrid('reload');	// reload the user data
                                } else {
                                    $.messager.show({// show error message
                                        title: 'Error',
                                        msg: result.msg
                                    });
                                }
                            }, 'json');
                        }
                    });
                }
            }
        </script>
    </head>
    <body>
        <h2>Manage Customer</h2>
        <div class="demo-info" style="margin-bottom:10px"><a href="../index-setting.php">back(กลับ)</a>
        </div>

        <table id="dg" title="Customer" class="easyui-datagrid" style="width:700px;height:400px"
               url="get_customer_name.php"
               toolbar="#toolbar" pagination="true"
               rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
                <tr>
                    <th field="customer_id" width="50">Customer ID</th>
                    <th field="customer_name" width="50">Customer Name</th>
                    <th field="customer_address" width="50">Customer Address</th>
                    <th field="customer_tel" width="50">Customer Tel.</th>
                    <th field="customer_fax" width="50">Customer Fax.</th>
                </tr>
            </thead>
        </table>
        <div id="toolbar">
            <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New Customer</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit Customer</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">Remove Customer</a>
        </div>

        <div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
            <div class="ftitle">Customer Information</div>
            <form id="fm" method="post" novalidate>
                <div class="fitem">
                    <label>Customer Name:</label>
                    <input name="customer_name" class="easyui-validatebox" required="true">
                    <label>Customer Address:</label>
                    <textarea rows="4" cols="50" name="customer_address" class="easyui-validatebox">
                    </textarea>
                    <label>Customer Tel:</label>
                    <input name="customer_tel" class="easyui-validatebox">
                    <label>Customer Fax:</label>
                    <input name="customer_fax" class="easyui-validatebox">
                                        <!--<input name="customer_address" class="easyui-validatebox">-->
                </div>
            </form>
        </div>
        <div id="dlg-buttons">
            <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
        </div>
    </body>
</html>