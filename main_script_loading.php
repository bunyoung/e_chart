<style>
    .box {
        width: 200px;
        height: 200px;
        background-color: beige;
        border: solid 3px darkcyan;
        border-radius: 100%;
    }
</style>
<script type="text/javascript">
  pageLoading({
  textTop:'70px',
  backColor:'rrgba(249, 16, 55, 1.02)',
  backBarColor:'#F91037',
  text:'<img src="img/logo.jpg" class="box"/> <br><h5><b><span fontcolor="#ffffff"><?php echo $client_name; ?></span></b></h5><br><a class="btn btn-danger btn-round btn-line">E-charge processing <b>{process} %</b></a>',
  textVisible:true,
  loadOut:true
});
  </script>
  <script>
      $(function() {
        Metis.MetisTable();
        Metis.metisSortable();
      });
  </script>