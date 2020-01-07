<!-- Modal Edit data -->
<div class="modal fade" id="cetakData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Per Priode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?=base_url('report/report_pdf_')?><?php echo $address ?>" method="post" target="_blank">
                        <table>
                            <tr>
                                <td>
                                    <div class="form-group">Dari Tanggal</div>
                                </td>
                                <td align="center" width="5%">
                                    <div class="form-group">:</div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" name="tgl_awal" id="" class="form-control" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">Sampai Tanggal</div>
                                </td>
                                <td align="center" width="5%">
                                    <div class="form-group">:</div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="date" name="tgl_akhir" id="" class="form-control" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="submit" name="print" class="btn btn-primary btn-sm" value="Cetak Data">
                                </td>
                            </tr>
                        </table>
                    </form>
                    
                </div>
                <div class="modal-footer">
                    
                    <form action="<?=base_url('report/report_pdf_')?><?php echo $address ?>" method="post" target="_blank">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" name="printAll" type="submit">Cetak Semua</button>
                    </form>
                </div>
        </div>
    </div>
</div>