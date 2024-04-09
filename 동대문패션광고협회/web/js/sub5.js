class graphDrow
{
    constructor()
    {
        this.graph = document.getElementById("graph");
        this.total = data.reduce((sum, value) => sum + value, 0);
    
        this.GetCsv();
    }

    GetCsv()
    {
        $.ajax({
            url: 'http://localhost/js/sub5.csv',
            method,
            beforeSend: function(xhr) {
                xhr.overrideMimeType('text/csv; charset=UTF-8');
            },
            success: (suc) => {
                var arr = [];
                const lines = suc.split('\r\n');
                for(let i = 0; i < lines.length; i++) {
                    const fields = lines[i].split(',');
                    if(fields.length == 8 || Number(fields[7]) >= 0) {
                        arr.push(fields[7]);
                    }
                }

                arr.shift();

                this.CreateGraph(arr);
            }
        });
    }

    CreateGraph(data) {
    

        let startAngle = 0;
    
        for (let i = 0; i < data.length; i++) {
          const dataPoint = document.createElement("div");
          dataPoint.style.position = "absolute";
          dataPoint.style.width = "100%";
          dataPoint.style.height = "100%";
          dataPoint.style.clip = "rect(0, 150px, 300px, 0)";
          dataPoint.style.transformOrigin = "center";
          dataPoint.style.transform = `rotate(${startAngle}deg)`;
    
          const angle = (data[i] / total) * 360;
    
          const sector = document.createElement("div");
          sector.style.position = "absolute";
          sector.style.top = "0";
          sector.style.left = "0";
          sector.style.width = "100%";
          sector.style.height = "100%";
          sector.style.background = `hsl(${i * (360 / data.length)}, 70%, 50%)`;
          sector.style.transformOrigin = "center";
          sector.style.transform = `rotate(${angle}deg)`;
    
          dataPoint.appendChild(sector);
          graph.appendChild(dataPoint);
    
          startAngle += angle;
        }
    }
}


const data = [20, 30, 15, 10, 25]; // 예시 데이터

window.onload = () => {
    var app = new graphDrow();
}