import { Box } from '@mui/system';
import { BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, Title, Tooltip } from 'chart.js';
import React from 'react';
import { Bar } from 'react-chartjs-2';
import useBarChart from '../hooks/useBarChart';

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

function BarChart(): React.ReactElement {
    const { options, data } = useBarChart();

    return (
        <React.Fragment>
            <Box sx={{ height: '450px', width: '100%' }}>
                <Bar options={options} data={data} />
            </Box>
        </React.Fragment>
    );
}

export default BarChart;
