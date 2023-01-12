import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { getAxiosWithToken } from '../../../../configuration/axiosInstance';
import { IChartData } from '../interface/pieChart';

function usePieChart() {
    const [data, setData] = useState<any>({
        datasets: []
    });

    const [pieData, setPieData] = useState<IChartData[] | null>();

    useEffect(() => {
        //  call data for chart 2022
        const year: number = 2022;
        getAxiosWithToken()
            .get(`/api/dashboard/topCategories?year=${year}`)
            .then((res) => {
                const data: IChartData[] = res.data.map((item: IChartData) => {
                    return item;
                });

                setPieData(data);
            })
            .catch((err) => {
                console.log(err);
            });
    }, []);

    useEffect(() => {
        const pieDataPrepare = {
            labels: pieData?.map((item) => item.category_name),
            datasets: [
                {
                    label: '#sell_quantity',
                    data: pieData?.map((item) => item.sell_quantity),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }
            ]
        };
        setData(pieDataPrepare);
    }, [pieData]);

    return { data };
}

export default usePieChart;
