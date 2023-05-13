function extractData(str) {
    const strs = str.split('sep');
    const data = [];
  
    strs.forEach((str) => {
      data.push(str.split('|'));
    });
  
    return data;
  }  