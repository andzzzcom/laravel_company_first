/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
    $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
    e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
*/

function multiCheck(tb_var) {
    tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
            a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
    }),
    tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
    })
}

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

    var checker = $('#' + clickchk);
    var multichk = $('.' + relChkbox);


    checker.click(function () {
        multichk.prop('checked', $(this).prop('checked'));
    });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
    template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}


	$("#btnCheckerOrder").click(function(){
		if($("#id_order").val()=='') {
			alert('Id Cannot Empty');
			return false;
		}
		
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method:'POST',
			data: {id:$("#id_order").val()},
			cache:true,
			url:base_url + '/admin/order/checker',
			success:function(result)
			{
				var res = (result==-1)?'Not Found !':result;
				var str = "Status Transaksi: ";
				alert(str+res);
			}
		});
	})
	
	function updateStatus(id, stat)
	{
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method:'POST',
			data: {id:id, stat:stat},
			cache:true,
			url:base_url + '/admin/setting/duitku/status',
			success:function(result)
			{
				alert("Successfully Updated!");
				location.reload();
			}
		});
	}
	
	function updateStatusExpired()
	{
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method:'POST',
			cache:true,
			url:base_url + '/admin/order/status/expired',
			success:function(result)
			{
				if(result==1)
					alert("Successfully Updated!");
				else
					alert("Failed Updated!");
			}
		});
	}