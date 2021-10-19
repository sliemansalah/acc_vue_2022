const actions = {
  getData({}, queryParams) {

    return new Promise((resolve, reject) => {
      axios.get(window.server_url + `/api/seller/order`, {
        params: queryParams
      })
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
        axios.get(window.server_url + `/api/seller/order/${id}`)
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
      if(data.is_percent) data.is_percent= 1; else data.is_percent=0;
      if(data.status) data.status= 1; else data.status=0;
      axios.post(window.server_url + `/api/seller/order`, data)
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
      if(data.is_percent) data.is_percent= 1; else data.is_percent=0;
      if(data.status) data.status= 1; else data.status=0;
      axios.post(window.server_url + `/api/seller/order/${data.id}`, data)
        .then((response) => {
          resolve(response.data);
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  updateStatus({}, data) {
    return new Promise((resolve, reject) => {
      axios.put(window.server_url + `/api/seller/order/`, JSON.parse(data))
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
        axios.delete(window.server_url + `/api/seller/order`, {
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
