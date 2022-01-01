

<?php $__env->startSection("content"); ?>
<p>Hi

<p>Welcome to my <?php echo e($blog); ?>, we're glad to have you 🎉🙏</p>

<p>We're all a big familiy here, so make sure to upload your user photo so we get to know you a bit better!</p>
<table class="btn btn-primary" role="presentation" border="0" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td align="left">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td><a href="<?php echo e($url); ?>" target="_blank">Upload user photo</a></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>


<p>- <?php echo e($name); ?></p>

</p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("../layouts.base_email", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/email/welcome.blade.php ENDPATH**/ ?>