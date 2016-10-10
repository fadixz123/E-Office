<div class="row" style="width:400px">
                    <form id="form-tambah-pegawai">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email">
                            </div>
							<div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control password" id="password">
                            </div>
							<div class="form-group">
                                <label for="password1">Ulangi Password</label>
                                <input name="password1" type="password" class="form-control password" id="password1">
								<i class="error1 text-danger"></i>
                            </div>
							<div class="form-group">
                                <label for="hakakses">Hak Akses</label>
                                <select class="form-control" name="hakakses">
									<option value="pegawai">Pegawai</option>
									<option value="kadin">Kepala Dinas</option>
									<option value="kabid">Kepala Bidang</option>
								</select>
                            </div>
							<i class="error text-danger"></i>
                        </div>
                    </form>
                </div>
