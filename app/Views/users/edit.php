<?= $this->extend('layouts/base'); ?>

<?= $this->section('content'); ?>
<form action="<?= site_url('/user/update/' . $user->id) ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="<?= old('name', $user->name) ?>">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?= old('email', $user->email) ?>">
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" value="<?= old('phone', $user->phone) ?>">
    </div>
    
    <div class="form-group">
        <label for="password">Password (leave blank if not changing)</label>
        <input type="password" name="password" class="form-control">
    </div>
    
    <!-- <div class="form-group">
        <label for="is_verified">Is Verified</label>
        <select name="is_verified" class="form-control">
            <option value="1" <?= old('is_verified', $user->is_verified) ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= !old('is_verified', $user->is_verified) ? 'selected' : '' ?>>No</option>
        </select>
    </div> -->
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?= $this->endSection() ?>
