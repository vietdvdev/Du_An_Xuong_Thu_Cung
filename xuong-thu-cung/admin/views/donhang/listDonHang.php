<!-- header  --> 
<?php include './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Quản lý danh Sách Đơn Hàng</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <?php 
                // Mảng ánh xạ trạng thái sang class màu badge Bootstrap 4
                $trangThaiBadgeClass = [
                    'Chưa xác nhận' => 'badge-secondary',
                    'Đã xác nhận' => 'badge-success',
                    'Chưa thanh toán' => 'badge-warning',
                    'Đã thanh toán' => 'badge-primary',
                    'Đang chuẩn bị hàng' => 'badge-info',
                    'Đang giao' => 'badge-secondary',
                    'Đã giao' => 'badge-success',
                    'Đã nhận' => 'badge-success',
                    'Thành công' => 'badge-success',
                    'Hoàn hàng' => 'badge-danger',
                    'Hủy đơn' => 'badge-danger',
                ];
              ?>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($listDonHang as $key => $donHang) { 
                    $trangThai = $donHang['ten_trang_thai'];
                    $class = $trangThaiBadgeClass[$trangThai] ?? 'text-bg-light'; // Màu mặc định nếu không xác định
                  ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= htmlspecialchars($donHang['ma_don_hang']) ?></td>
                      <td><?= htmlspecialchars($donHang['ten_nguoi_nhan']) ?></td>
                      <td><?= htmlspecialchars($donHang['sdt_nguoi_nhan']) ?></td>
                      <td><?= htmlspecialchars($donHang['ngay_dat']) ?></td>
                      <td><?= htmlspecialchars(number_format($donHang['tong_tien'])) ?> VNĐ</td>



                      <td><span class="badge <?= $class ?>"><?= htmlspecialchars($trangThai) ?></span></td>

                      <td>
                        <div class="btn-group">
                          <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang='. $donHang['id'] ?>"> 
                            <button class="btn btn-primary"><i class="far fa-eye"></i></button> 
                          </a>
                          <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang='. $donHang['id'] ?>"> 
                            <button class="btn btn-warning"><i class="fas fa-wrench"></i></button> 
                          </a>                   
                        </div>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->
</body>
</html>
