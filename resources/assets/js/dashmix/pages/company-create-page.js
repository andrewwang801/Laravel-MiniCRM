import {BasePage} from "./reusables/base-page";
import {initDatatable} from "./reusables/init-datatable";

export class CompanyCreatePage extends BasePage {

    constructor() {
        super();

        // Add image dimension validator
        let $submitBtn = $('#create-form').find('input:submit'),
            $photoInput = $('#logo'),
            $imgContainer = $('#imgContainer');

        $('#logo').change(function() {
            $photoInput.removeData('imageWidth');
            $imgContainer.hide().empty();

            let file = this.files[0];

            if (file.type.match(/image\/.*/)) {
                $submitBtn.attr('disabled', true);

                let reader = new FileReader();

                reader.onload = function() {
                    let $img = $('<img />').attr({ src: reader.result });

                    $img.on('load', function() {
                        $imgContainer.append($img).show();
                        let imageWidth = $img.width();
                        let imageHeight = $img.height();
                        $photoInput.data('imageWidth', imageWidth);
                        $photoInput.data('imageHeight', imageHeight);
                        if (imageWidth < 100 || imageHeight < 100) {
                            $imgContainer.hide();
                        } else {
                            // $img.css({ width: '200px', height: '200px' });
                        }
                        $submitBtn.attr('disabled', false);

                        this.validator.element($photoInput);
                    });
                }

                reader.readAsDataURL(file);
            } else {
                this.validator.element($photoInput);
            }
        });

        // Add image width validate method
        $.validator.addMethod('minImageWidth', function(value, element, minWidth) {
            return ($(element).data('imageWidth') || 0) > minWidth;
        }, function(minWidth, element) {
            let imageWidth = $(element).data('imageWidth');
            return (imageWidth)
                ? ("Your image's width must be greater than " + minWidth + "px")
                : "";
        });

        // Add image height validate method
        $.validator.addMethod('minImageHeight', function(value, element, minHeight) {
            return ($(element).data('imageHeight') || 0) > minHeight;
        }, function(minHeight, element) {
            let imageHeight = $(element).data('imageWidth');
            return (imageHeight)
                ? ("Your image's width must be greater than " + minHeight + "px")
                : "";
        });
        // End Add image dimension validator

        // Set validator to create form, { name: required, image : minimum 100 * 100 }
        let createForm = $('#create-form');
        this.validator = createForm.validate({
            ignore: [],
            errorClass: 'invalid-feedback animated fadeIn',
            errorElement: 'div',
            errorPlacement: (error, el) => {
                jQuery(el).addClass('is-invalid');
                jQuery(el).parents('.form-group').append(error);
            },
            highlight: (el) => {
                jQuery(el).parents('.form-group').find('.is-invalid').removeClass('is-invalid').addClass('is-invalid');
            },
            success: (el) => {
                jQuery(el).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                jQuery(el).remove();
            },
            rules: {
                'name': {
                    required: true
                },
                'logo': {
                    minImageWidth: 100,
                    minImageHeight: 100,
                }
            },
            messages: {
                'name': {
                    required: 'Please enter a name'
                },
                'logo': {
                    required: 'Min image size is 100 * 100'
                },

            }
        });
    }
}
