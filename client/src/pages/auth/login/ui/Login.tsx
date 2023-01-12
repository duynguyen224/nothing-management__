import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import LoadingButton from '@mui/lab/LoadingButton';
import { Card, CardContent } from '@mui/material';
import Avatar from '@mui/material/Avatar';
import Box from '@mui/material/Box';
import Container from '@mui/material/Container';
import CssBaseline from '@mui/material/CssBaseline';
import Grid from '@mui/material/Grid';
import Link from '@mui/material/Link';
import TextField from '@mui/material/TextField';
import Typography from '@mui/material/Typography';
import { Controller, useForm } from 'react-hook-form';
import useLogin from '../hooks/useLogin';

export default function Login(): React.ReactElement {
    const { loading, error, onSubmit } = useLogin();

    const {
        register,
        formState: { errors },
        control,
        handleSubmit
    } = useForm({
        defaultValues: {
            email: '',
            password: '',
            rememberMe: ''
        }
    });

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <Container component="main" maxWidth="xs">
                <CssBaseline />
                <Card sx={{ minWidth: 275, marginTop: 10 }}>
                    <CardContent
                        sx={{
                            display: 'flex',
                            flexDirection: 'column',
                            alignItems: 'center',
                            justifyContent: 'center'
                        }}
                    >
                        <Avatar sx={{ bgcolor: 'secondary.main' }}>
                            <LockOutlinedIcon />
                        </Avatar>
                        <Typography component="h1" variant="h5">
                            Sign in
                        </Typography>
                        <Typography component="h3" variant="h6" sx={{ color: 'red', fontSize: '1rem' }}>
                            <Box>{error ? error : ''}</Box>
                        </Typography>
                        <Box sx={{ mt: 1 }}>
                            <Controller
                                name="email"
                                control={control}
                                render={({ field }) => (
                                    <TextField
                                        {...field}
                                        margin="normal"
                                        fullWidth
                                        id="email"
                                        label="Email"
                                        autoComplete="email"
                                        error={!!errors?.email}
                                        helperText={errors?.email ? errors?.email.message : null}
                                        {...register('email', {
                                            required: 'Email is required',
                                            pattern: {
                                                value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                                                message: 'Invalid email address'
                                            }
                                        })}
                                    />
                                )}
                            />
                            <Controller
                                name="password"
                                control={control}
                                render={({ field }) => (
                                    <TextField
                                        {...field}
                                        margin="normal"
                                        fullWidth
                                        id="password"
                                        label="Password"
                                        type="password"
                                        autoComplete="password"
                                        error={!!errors?.password}
                                        helperText={errors?.password ? errors?.password.message : null}
                                        {...register('password', { required: 'Password is required' })}
                                    />
                                )}
                            />
                            <LoadingButton
                                type="submit"
                                loading={loading}
                                variant="contained"
                                fullWidth
                                loadingPosition="start"
                                sx={{ mt: 3, mb: 2 }}
                            >
                                Sign In
                            </LoadingButton>
                            <Grid container>
                                <Grid item xs>
                                    <Link href="#" variant="body2">
                                        Forgot password?
                                    </Link>
                                </Grid>
                                <Grid item>
                                    <Link href="#" variant="body2">
                                        {"Don't have an account? Sign Up"}
                                    </Link>
                                </Grid>
                            </Grid>
                        </Box>
                    </CardContent>
                </Card>
                <Copyright sx={{ mt: 8, mb: 4 }} />
            </Container>
        </form>
    );
}

function Copyright(props: any) {
    return (
        <Typography variant="body2" color="text.secondary" align="center" {...props}>
            {'Copyright © '}
            <Link color="inherit" href="https://mui.com/">
                Your Website
            </Link>{' '}
            {new Date().getFullYear()}
            {'.'}
        </Typography>
    );
}
