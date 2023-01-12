import React, { useEffect, useState } from 'react';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';
import { Pie } from 'react-chartjs-2';
import axios from 'axios';
import usePieChart from '../hooks/usePieChart';

ChartJS.register(ArcElement, Tooltip, Legend);

function PieChart(): React.ReactElement {
    const { data } = usePieChart();

    return (
        <React.Fragment>
            <p>Top 5 categories that sell the most products - 2022</p>
            <Pie data={data} />
        </React.Fragment>
    );
}

export default PieChart;
