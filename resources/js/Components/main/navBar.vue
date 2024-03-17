<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark-subtle">
            <div class="container-fluid">

                <a class="navbar-brand">Welcome our page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class=" navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">


                        

                        <template v-if="$page.props.auth.user" >
                            
                            <li class="nav-item">
                                <Link class="nav-link text-success " :href="route('home')">Home </Link>
                            </li>
                            <li class="nav-item">
                                <button @click.prevent="logout" class="nav-link text-danger">Logout</button>
                            </li>
                        </template>


                        <template v-else>
                            <li class="nav-item">
                                <Link class="nav-link text-success" :href="route('dashboard')">Dashboard</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link text-primary" :href="route('login')">Login</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link text-danger" :href="route('register')">Register</Link>
                            </li>
                        </template>

                        

                    </ul>
                </div>
            </div>
        </nav>


    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    components: {
        Link
    },
    methods: {
        async logout() {
            
            await axios.post(route('logout'));
            window.location.href = '/';

            

        }
    }
}

</script>

<style lang="css" scoped></style>