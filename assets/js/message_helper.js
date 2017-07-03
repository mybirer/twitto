var MessageHelper = {
    $__title : '',
    $__class : 'info',
    $__icon : 'info',
    $__message : "",
    setMessage : function($title,$class,$icon,$message){
        this.$__title=$title;
        this.$__class=$class;
        this.$__icon=$icon;
        this.$__message=$message;
    },
    getMessageHTML : function(){
        if(this.$__message && this.$__message.length>0){
            return '<div class="alert alert-'+this.$__class+'">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h4><i class="icon fa fa-'+this.$__icon+'"></i> '+this.$__title+'</h4>'+this.$__message+'</div>';
        }
    }
}