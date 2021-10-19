const actions = {
  getData({}) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/category`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  findData({}, id) {
    return new Promise((resolve, reject) => {
        axios.get(window.server_url + `/api/seller/category/${id}`)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  saveData({}, data) {
    return new Promise((resolve, reject) => {
       let form = new FormData();
       if( data.name) form.append('name', data.name);
        form.append('status', data.status?1:0);
        form.append('store_id', 1);
       if(data.parent_id) form.append('parent_id', data.parent_id);
      axios.post(window.server_url + `/api/seller/category`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateData({}, data) {
    return new Promise((resolve, reject) => {
       let form = new FormData();
       if( data.name) form.append('name', data.name);
        form.append('status', data.status?1:0);
        form.append('store_id', 1);
      axios.post(window.server_url + `/api/seller/category/${data.parent_id}`, form)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  
  removeData({}, id) {
    return new Promise((resolve, reject) => {
        axios.delete(window.server_url + `/api/seller/category`, {
            data: {
                ids: id
            }
        })
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  }
  
}
export default {
  namespaced: true,
  actions,
}
