/**
 * 页面加载完，回退页面bug
 */
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]);
    return null; //返回参数值
}

$(function () {
    //回退页面保持
    for (var i = 0; i < $('#checkbox.checkbox-row, .select-on-check-all').length; i++) {
        if ($('#checkbox.checkbox-row, .select-on-check-all')[i].checked == true) {
            $('#SelectedSearch').show();
        }
    }


    //是否显示clear selection按钮
    var checkedIdArr = getUrlParam('checkedIdArr');
    if (checkedIdArr != null && checkedIdArr !== '') {
        $('#SelectedClear').show();
    } else {
        $('#SelectedClear').hide();
    }

});

/**
 * 多选框
 */
$('.checkbox-row').click(function () {
    var checkBoxList = true;
    for (var i = 0; i < $('#checkbox.checkbox-row').length; i++) {
        if ($('#checkbox.checkbox-row')[i].checked !== true) {
            checkBoxList = false;
            $('#SelectedSearch').hide();
        }
    }

    if (checkBoxList) {
        $('#SelectedSearch').show();
    }
});

/**
 * 全选多选框
 */
$(".select-on-check-all").click(function () {
    //全选
    if ($(this).is(":checked") && $('#checkbox.checkbox-row').length > 0) {
        $('#SelectedSearch').show();
    } else {
        $('#SelectedSearch').hide();
    }
});

/**
 * 匹配搜索点击事件
 */
$("#SelectedSearch").click(function () {
    var param = $('#w0').serialize();
    var checkedIdArr = [];
    $('.checkbox-row:checked').each(function (index, element) {
        checkedIdArr.push($(this).val());
    });
    if (checkedIdArr.length > 0) {
        param += encodeURI("&checkedIdArr=" + checkedIdArr.toString());
    }
    window.location.href = window.location.origin + window.location.pathname + "?" + param;
});

/**
 * 匹配去除搜索事件
 */
$("#SelectedClear").click(function () {
    var param = $('#w0').serialize();
    window.location.href = window.location.origin + window.location.pathname + "?" + param;
});

/**
 * 导出
 */
$(".supplier-export").click(function () {
    var param = $('#w0').serializeArray();
    var checkedIdArr = [];
    $('.checkbox-row:checked').each(function (index, element) {
        checkedIdArr.push($(this).val());
    });
    var postdata = {};
    $(param).each(function (i) {
        postdata[this.name] = this.value
    });


    if (checkedIdArr.length === 0) {
        if (!confirm('Export all data ！！！')) {
            return false;
        }
    } else {
        if (!confirm('Export selected rows，If you want to export all data, unchecked the row, please')) {
            return false;
        }
    }

    postdata['checkedIdArr'] = checkedIdArr.join(",");

    $.ajax({
        type: "POST",
        url: "/supplier/export",
        data: postdata,
        success: function (result) {
            // result格式，不能是json
            // result = 'a,b,c\n5,6,7\n1,2,3',
            console.log(result);
            // "\ufeff"防止乱码
            result = "\ufeff" + result;
            var blob = new Blob([result], {type: 'application/vnd.ms-excel'});
            var downloadUrl = URL.createObjectURL(blob);
            var a = document.createElement("a");
            a.href = downloadUrl;
            a.download = "suppliers.csv";
            document.body.appendChild(a);
            a.click();
        },
        error: function () {

        }
    });
});

