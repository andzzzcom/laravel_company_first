		
	function changeMember(id, id_proj)
	{
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method:'POST',
			data: {id:id, id_proj:id_proj},
			cache:true,
			url:base_url + '/admin/project/member/add',
			success:function(result)
			{
				console.log(result);
			}
		});
	}