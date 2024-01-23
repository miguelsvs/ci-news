<div class="container text-light mt-4">
    <div class="col-lg-12">
        <h2>Profile</h2>
    </div>
    <div class="m-2">
        <div>
            <h4>Name:</h4>
            <div><?= esc($user['username']) ?></div>
        </div>
        <div>
            <h4>Lastname:</h4>
            <div><?= esc($user['lastname']) ?></div>
        </div>
        <div>
            <h4>Email:</h4>
            <div><?= esc($user['email']) ?></div>
        </div>
    </div>
</div>


