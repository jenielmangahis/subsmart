const date_pipe = (date) => {
    const date_obj = new Date(date);
    if( Object.prototype.toString.call(date_obj) === "[object Date]"  && !isNaN(date_obj)) {
        let formatted_date = (date_obj.getMonth() + 1) + "-" + date_obj.getDate() + "-" + date_obj.getFullYear()
        return formatted_date;
    }else {
        return 'invalid date';
    };
}