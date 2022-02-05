<?php

$modalType = isset($modalType) ? $modalType : "";
(array) $form = isset($form) ? $form : [];

?>
<div class="modal fade" id="modal-change-role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog <?= $modalType ?>" role="document">
    <form>
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="loading"></div>
          <div class="row">
            <?php foreach ($form as $key => $value) : ?>
              <div class="<?= $value['col'] ?>">
                <div class="form-group">
                  <label for="<?= $key ?>"><?= $value['label'] ?></label>
                  <?php if ($value['type'] == "text") : ?>
                    <input type="text" class="form-control" id="<?= $key ?>" name="<?= $key ?>" placeholder="<?= $value['placeholder'] ?>" value="<?= isset($value['value']) ? $value['value'] : "" ?>">
                  <?php elseif ($value['type'] == "password") : ?>
                    <input type="password" class="form-control" id="<?= $key ?>" name="<?= $key ?>" placeholder="<?= $value['placeholder'] ?>" value="<?= isset($value['value']) ? $value['value'] : "" ?>">
                  <?php elseif ($value['type'] == "select") : ?>
                    <select class=" form-control" id="<?= $key ?>" name="<?= $key ?>">
                      <?php foreach ($value['options'] as $option) : ?>
                        <option value="<?= $option['id'] ?>"><?= $option['value'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  <?php endif; ?>
                  <div class="invalid-feedback"></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>