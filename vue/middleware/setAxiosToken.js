export default function(token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}
