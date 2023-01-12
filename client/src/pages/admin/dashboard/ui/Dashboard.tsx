import { Card } from '@mui/material';
import { Box } from '@mui/system';
import React, { useContext } from 'react';
import BarChart from '../../../../components/admin/dashboard/ui/BarChart';
import PieChart from '../../../../components/admin/dashboard/ui/PieChart';
import { AppContext } from '../../../../context/AppContext';

function Dashboard(): React.ReactElement {
    const { state } = useContext(AppContext);

    return (
        <React.Fragment>
            <Card sx={{ padding: '50px' }}>
                <h1>Dashboard</h1>
                <h1>hello {state.currentUser.name}</h1>
                <Box sx={{ height: '450px', width: '100%' }}>
                    <BarChart />
                </Box>
                <Box sx={{ marginBottom: 10 }}></Box>
                <Box sx={{ height: '450px', width: '100%' }}>
                    <PieChart />
                </Box>
                <Box sx={{ marginBottom: 10 }}></Box>
            </Card>
        </React.Fragment>
    );
}

export default Dashboard;
