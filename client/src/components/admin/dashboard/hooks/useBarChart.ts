import axios from 'axios';
import { useEffect, useState } from 'react';
import { axiosInstance } from '../../../../configuration/axiosInstance';
import { IChartData } from '../interface/barChart';
import { monthText, monthNumber } from './../../../../configuration/constants/month';

export const options: any = {
    responsive: true,
    plugins: {
        legend: {
            position: 'top' as const
        },
        title: {
            display: true,
            text: 'Doanh thu (VNĐ)'
        }
    }
};

const labels: string[] = monthText;

function useBarChart() {
    const [data, setData] = useState<any>({
        datasets: []
    });
    const [chartData1, setChartData1] = useState<IChartData[] | null>();
    const [chartData2, setChartData2] = useState<IChartData[] | null>();

    useEffect(() => {
        axiosInstance()
            .get('/api/dashboard/revenue?year=2021')
            .then((res) => {
                const data: IChartData[] = res.data.map((item: IChartData) => {
                    return item;
                });
                setChartData1(data);
            })
            .catch((err) => {
                console.log(err);
            });

        // call data for chart 2022
        axiosInstance()
            .get('/api/dashboard/revenue?year=2022')
            .then((res) => {
                const data: IChartData[] = res.data.map((item: IChartData) => {
                    return item;
                });
                setChartData2(data);
            })
            .catch((err) => {
                console.log(err);
            });
    }, []);

    useEffect(() => {
        const chartData = {
            labels,
            datasets: [
                {
                    label: 'Doanh thu 2021',
                    data: getChartData(chartData1),
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                },
                {
                    label: 'Doanh thu 2022',
                    data: getChartData(chartData2),
                    backgroundColor: 'rgba(53, 162, 235, 0.5)'
                }
            ]
        };
        setData(chartData);
    }, [chartData1, chartData2]);

    return { options, data };
}

export default useBarChart;

const getChartData = (data: any) => {
    if (data) {
        const revenue: any = [];
        const monthArray = data?.map((item: any) => item.month);
        monthNumber.forEach((element) => {
            if (monthArray != null && monthArray !== undefined && monthArray?.includes(element)) {
                const founded = data.find((x: any) => x.month == element);
                revenue.push(founded.revenue);
            } else {
                revenue.push(0);
            }
        });
        return revenue;
    } else {
        return [];
    }
};
