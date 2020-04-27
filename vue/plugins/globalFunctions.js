Vue.prototype.isAuthorized = data => {
    for (const permission of permissions) {
        if (data == permission.name) {
            return true;
        }
    }
    return false;
};
Vue.prototype.$SwalChecks = warningText => {
    return Swal.fire({
        title: "Are you sure?",
        text: warningText,
        type: "warning",
        confirmButtonColor: "#3085d6",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "No"
    });
};
Vue.prototype.$loader = () => {
    return Vue.$loading.show({
        color: "#fdb813",
        loader: "dots",
        backgroundColor: "#000000"
    });
};

Vue.prototype.getBack = () => {
    history.go(-1);
};
