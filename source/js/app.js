var baseUrl = window.location.origin+'/emonevpanel';
$(document).ready(function() {
	/* Deklarasi Plugin Select */
	$(".selectpicker").selectpicker();

	/* Function Get Program SKPD */
	var getProgramSelect = function(idSkpd,idTahun) {
		$.get(baseUrl+'/api/v1/program/'+idSkpd+'/'+idTahun,function(data) {
			$("select[name='program_id']").empty();
			$.each(data, function(index,value) {
				$("select[name='program_id']").append("<option value="+value.id+">"+value.program+"</option>").selectpicker('refresh');
			});
		});
	};

	var getKpaSelect = function(id) {
		$.get(baseUrl+'/api/v1/kpa/'+id,function(data) {
			$("select[name='pegawai_id']").empty();
			$.each(data, function(index,value) {
				$("select[name='pegawai_id']").append("<option value="+value.id+">"+value.pegawai+"</option>").selectpicker('refresh');
			});
		});
	}

	var getKegiatanSelect = function(skpd,tahun) {
		$(".icon-loading").show();
		$.get(baseUrl+'/api/v1/kegiatan/'+skpd+'/'+tahun,function(data) {
			$("select[name='kegiatan_id']").empty();
			$.each(data, function(index,value) {
				$("select[name='kegiatan_id']").append("<option value="+value.id+">"+value.kegiatan+"</option>").selectpicker('refresh');
			});
			$(".icon-loading").hide();
		});
	}

	var getPaketSelect = function(kegiatan,tahun) {
		$.get(baseUrl+'/api/v1/paket/'+kegiatan+'/'+tahun,function(data) {
			$("select[name='paket_id']").empty();
				$("select[name='paket_id']").append("<option value=''>---- Pilih Paket ----</option>")
			$.each(data, function(index,value) {
				$("select[name='paket_id']").append("<option value="+value.id+" data-pagu="+value.nilai_pagu_paket+">"+value.paket+"</option>").selectpicker('refresh');
			});
			$(".icon-loading").hide();
		});
	}

	// var getLelangSelect = function(skpd,tahun) {
	// 	$.get(baseUrl+'/api/v1/lelang/'+skpd+'/'+tahun,function(data) {
	// 		// $("select[name='paket_id']").empty();
	// 		// $.each(data, function(index,value) {
	// 		// 	$("select[name='paket_id']").append("<option value="+value.id+">"+value.paket+"</option").
	// 		// })
	// 		console.log(data);
	// 	})
	// }

	/* onChange Tahun to Get Program */
	$('#selectTahunGetProgram').change(function() {
		var idTahun = $(this).val();
		var idSkpd = $("input[name='skpd_id']").val();
		$("input[name='tahun_id']").val(idTahun);
		getProgramSelect(idSkpd,idTahun);
	});

	/* onChange SKPD to GET Program */
	$("#selectSkpdGetProgramAndKpaOption").change(function() {
		var idSkpd = $(this).val();
		var idTahun = $("input[name='tahun_id']").val();
		getProgramSelect(idSkpd,idTahun);
		getKpaSelect(idSkpd);
	});

	/* onChange Skpd to GET idSkpd*/
	$("#getIdSkpd").change(function() {
		var idSkpd = $(this).val();
		$("input[name='skpd_id']").val(idSkpd);
	});

	/* onChange Skpd to GET idSkpd and Kpa*/
	$("#getIdSkpdAndKpa").change(function() {
		var idSkpd = $(this).val();
		$("input[name='skpd_id']").val(idSkpd);
		getKpaSelect(idSkpd);
	});

	/* onChange Tahun to GET Kegiatan */
	$("#selectTahunGetKegiatan").change(function() {
		var idTahun = $(this).val();
		var idSkpd = $("input[name='skpd_id']").val();
		// console.log(idTahun);
		// console.log(idSkpd);
		$("#tahunId").val(idTahun);
		getKegiatanSelect(idSkpd,idTahun);
	});

	$('#selectKegiatanGetPaket').change(function() {
		var idKegiatan = $(this).val();
		var idTahun = $("select[name='tahun_id']").val();
		getPaketSelect(idKegiatan,idTahun);
	});

	$('#selectTahunGetLelang').change(function() {
		var idTahun = $(this).val();
		var idSkpd = $("input[name='skpd_id']").val();
		$.get(baseUrl+'/api/v1/lelang/'+idSkpd+'/'+idTahun,function(data) {
			$("select[name='lelang_id']").empty();
			$.each(data, function(index,value) {
				$("select[name='lelang_id']").append("<option value="+value.id+">"+value.paket.paket+"</option");
			});
		});
	})

	/* onChange Jenis Belanja */
	

	/* hitung BL */
	$("#hitungBl").click(function() {
		var blp = Number($("input[name='blp']").val().replace(/[Rp.]+/g,""));
		var blnp = Number($("input[name='blnp']").val().replace(/[Rp.]+/g,""));
		var total = blp+blnp;
		$("#pagu").maskMoney('mask',total);
		$("input[name='pagu']").val(total);
		return false;
	});
	

	
	/* onChange Jabatan  */
	$("#selectJabatan").change(function() {
		var jabatan = $(this).val();
		if(jabatan == 0) {
			$("#operatorJabatan").show();
		} else {
			$("#operatorJabatan").hide();
		}
	});

	

});