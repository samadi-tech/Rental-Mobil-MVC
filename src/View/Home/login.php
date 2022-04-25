<!-- Login Member -->
<div class="container-form">
    <h1>Login Member</h1>
    <hr />

    <div class="container-login">
        <form action="<?= BASEURL; ?>/transaksi/booking" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" /></td>
                </tr>
            </table>
            <div class="form-btn">
                <button type="submit">Login</button>
                <p class="btn-link">Daftar</p>
            </div>

            <p>Lupa kata sandi ?</p>
        </form>
    </div>
</div>