import clientAPI from '../services/axiosConfig.js';

export default ({
    index(resource) {
        return `http://localhost:8888/api/${resource}`;
    },

    show(resource, id) {
        return `http://localhost:8888/api/${resource}/${id}`;
    },

    create(payload) {
        return "Not implemented";
    },

    update(payload, id) {
        return "Not implemented";
    },

    delete(id) {
        return "Not implemented";
    }

});