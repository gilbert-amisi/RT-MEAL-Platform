<div class="card mt-4">
    <div class="card-header h5">
        <i style="color: red;" class="fas fa-user-plus" aria-hidden="true"></i> User Registration
    </div>
    <div class="card-body">
        <form action="../controllers/compte/compteController.php" method="POST" class="row">
            <div class="col">
                <div class="form-group">
                    <label class="control-label" for="my-select">User identity</label>
                    <input class="form-control" type="text" name="tb_identite" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="my-select">Account type</label>
                    <select class="form-control" id="my-select" class="custom-select" name="cb_typeCompte" required>
                        <option value="none">Choose</option>
                        <option value="Call-Center Agent">Call-Center Agent</option>
                        <option value="TPM Proxy Monitor">TPM Proxy Monitor</option>
                        <option value="TPM Supervisor">TPM Supervisor</option>
                        <option value="TPM Coordinator">TPM Coordinator</option>
                        <option value="Partner">Partner / Client</option>
                        <option value="admin">System Administrator</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="my-select">Email</label>
                    <input class="form-control" type="text" name="tb_email" required>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label class="control-label" for="my-select">Username or email (For login)</label>
                    <input class="form-control" type="text" name="tb_nomUtilisateur" required>
                </div>
                <div class="form-group">
                    <label class="control-label" for="my-select">Password</label>
                    <input class="form-control" type="password" name="tb_motDePasse">
                    <label class="control-label" for="my-select">Password confirmation</label>
                    <input class="form-control" type="password" name="tb_motDePasseSecond">
                </div>
            </div>
            <br> <br>
            <div class="form-group">
                <button class="btn btn-success" name="bt_add" type="submit">
                    <i class="fas fa-save" aria-hidden="true"></i> Save account
                </button>
            </div>
        </form>

    </div>
</div>