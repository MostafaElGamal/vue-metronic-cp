import { store } from "../Store/store";

export default function() {
    if (store.getters.loggedin) {
        window.permissions = store.state.permissions;
    }
}
