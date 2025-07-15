import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome" />
            <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                <h1 className="text-4xl font-bold mb-4">Welcome to Our Application</h1>
                {auth.user ? (
                    <p className="text-lg">Hello, {auth.user.name}!</p>
                ) : (
                    <p className="text-lg">Please log in to continue.</p>
                )}
                <Link href="/login" className="mt-4 text-blue-500 hover:underline">
                    Login
                </Link>
            </div>
        </>
    );
}
