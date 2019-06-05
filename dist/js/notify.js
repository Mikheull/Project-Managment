class Notify {
    constructor(){
        this.pluginOptions = {
            content: 'contenu',
            animation: 'fade',
            clickToHide: true,
            autoHide: true,
            autoHideDelay: 4000,
            position: 'center-top',
            size: 'md',
            theme: 'dark',
            showDuration: 400,
            hideDuration: 200,
        }

        this.styles = {
            error: 'background: #c64444;border: solid 1px #b63f3f;color: #FFF',
            success: 'background: #3db56e;border: solid 1px #38a766;color: #FFF',
            warning: 'background: #ebc063;border: solid 1px #d8b05a;color: #FFF',
            dark: 'background: #262E3E;border: solid 1px #1d2330;color: #FFF',
            light: 'background: #FFF;border: solid 1px #F5F5F5;color: #262E3E',

            sm: 'width: 25vw',
            md: 'width: 50vw',
            lg: 'width: 100vw',
        }
    }

    new(options){

        // Options
        let content = options.content ? options.content : this.pluginOptions.content;
        let animation = options.animation ? options.animation : this.pluginOptions.animation;
        let clickToHide = options.clickToHide ? options.clickToHide : this.pluginOptions.clickToHide;
        let autoHide = options.autoHide ? options.autoHide : this.pluginOptions.autoHide;
        let autoHideDelay = options.autoHideDelay ? options.autoHideDelay : this.pluginOptions.autoHideDelay;
        let position = options.position ? options.position : this.pluginOptions.position;
        let size = options.size ? options.size : this.pluginOptions.size;
        let theme = options.theme ? options.theme : this.pluginOptions.theme;
        let showDuration = options.showDuration ? options.showDuration : this.pluginOptions.showDuration;
        let hideDuration = options.hideDuration ? options.hideDuration : this.pluginOptions.hideDuration;


        // Init
        let messageContainer = `<div class="ntf-message-wrapper">${content}</div>`;
        let mainContainer = `<div class="notify ${size} ${theme} ${position} ${animation}" data-clickToHide="${clickToHide}"> ${messageContainer} </div>`;


        // Send
        setTimeout(function() {
            $( 'body' ).prepend( mainContainer );
            $( '.ntf-message-wrapper' ).hide().fadeIn( showDuration )

            setTimeout(function() {
                $('.ntf-message-wrapper').fadeOut( hideDuration );
                $( '.notify' ).remove()
            }, autoHideDelay);

        }, showDuration);
    }



};

// Retirer un membre
$(document).on("click", "[data-clickToHide='true']", function(e) {
    $('.notify').fadeOut( 200 );
});


let notify = new Notify();