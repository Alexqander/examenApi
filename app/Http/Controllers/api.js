const loadPeople = async () => {
    try {
        const response = await fetch("http://127.0.0.1:8000/api/school/index");
        const datos = await response.json();
        let profesores = "";
        let course = "";
        datos.data.map((per, i) => {
            profesores =
                profesores +
                `
        <tr>
          <th scope='row'>${i}</th>
          <th>${per.id}</th>
          <th>${per.name}</th>
          <th>${per.first_surname}</th>
          <th>${per.second_surname}</th>
          <th>${per.degree}</th>
          <th>${course}</th>
        </tr>
      
      `;
        });
        document.getElementById("table").innerHTML = profesores;
    } catch (error) {
        console.error(error);
    }
};

loadPeople();
