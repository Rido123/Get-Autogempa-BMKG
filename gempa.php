<script type="text/javascript">
$(document).ready(function(){
    //load_gempa();
    function load_gempa(){
        $.ajax({
            url: '<?php echo base_url(); ?>module/url_gempa.php',
            //url: '<?php echo base_url(); ?>module/test.php',
            dataType: 'json',
            success: function(json) {
                console.log("communition with server success."+json);
                $.each(JSON.parse(json), function(idx, obj) {
                    var todate = '<?php echo date("d-M-y"); ?>';
                    var totime = '<?php echo date("H:i:s"); ?>';
                    //var totime = '01:38:43';
                    var tgl = obj.Tanggal;
                    var jam = obj.Jam.substring(0,8);
                    var jam2 = obj.Jam;
                    var wkt_gempa = tgl+" "+jam2;
                    var kordinat = obj.point.coordinates;
                    var lintang = obj.Lintang;
                    var bujur = obj.Bujur;
                    var kordinats = kordinat+","+bujur+","+lintang;
                    var magnitude = obj.Magnitude;
                    var kedalaman = obj.Kedalaman;
                    var wil_1 = obj.Wilayah1;
                    var wil_2 = obj.Wilayah2;
                    var wil_3 = obj.Wilayah3;
                    var wil_4 = obj.Wilayah4;
                    var wil_5 = obj.Wilayah5;
                    var wilayah = wil_1+","+wil_2+","+wil_3+","+wil_4+","+wil_5;
                    var potensi = obj.Potensi;
                    //$("#update").text(jam);
                    if(tgl == todate && totime == jam) {
                        var audio = new Audio('<?php echo base_url(); ?>assets/music/Warning.mp3');
                        audio.play();
                    }
                    $('#magnitude').text(magnitude);
                    $('#potensi').text(potensi);
                    $('#wkt_gempa').text(wkt_gempa);
                    $('#kordinat').text(kordinats);
                    $('#kedalaman').text(kedalaman);
                    $('#wilayah').text(wilayah);
                });
            },
            error: function(data, status, err) {
              console.log('error communition with server.');
            }
        });
    }
    load_gempa();
    setInterval(function(){
        load_gempa() // this will run after every 5 seconds
    }, 1000);
});
</script>