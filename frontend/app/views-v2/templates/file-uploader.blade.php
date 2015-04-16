<div ng-controller="FileUploadController" class="file-upload-wrapper" uploader="uploader" nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter">
    @include('partials/file-uploader', array('uploadEnabled' => true, 'actionsEnabled' => true))
</div>