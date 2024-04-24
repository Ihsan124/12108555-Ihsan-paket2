                <!-- Basic Modal -->
                <div class="modal fade" id="basicModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Stock</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form class="row g-3" action="{{ route('produk.updateStock', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <!-- Vertical Form -->
                                    @csrf
                                    @method('PATCH')
                                    <div class="col-12 mt-2">
                                        <label for="product_name" class="form-label">Nama Produk</label>
                                        <input type="text" name="product_name" class="form-control" value="{{ $dt->product_name }}" disabled required>
                                    </div>
                                    <!-- Vertical Form -->

                                    <div class="col-12 mt-3">
                                        <label for="stock" class="form-label">Sotck</label>
                                        <input type="number" name="stock" class="form-control" value="{{ $dt->stock }}" required>
                                    </div>
                                    <!-- Vertical Form -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Close</button>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-send"></i> Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Basic Modal-->