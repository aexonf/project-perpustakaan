import React from "react";
import { Input } from "@/Components/ui/input";
import { Label } from "@/Components/ui/label";
import { Button } from "@/Components/ui/button";
import { useForm } from "@inertiajs/inertia-react";

export default function Login({ message }) {
    const { data, setData, post, processing, setError, errors } = useForm({
        username: "",
        password: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post("/login", {
            onError: (e) => setError(e),
        });
    };

    return (
        <div className="flex w-screen h-screen justify-center bg-muted items-center">
            <div className="p-8 w-full max-w-lg bg-white rounded-md">
                <h3 className="text-2xl font-semibold mb-2">Selamat Datang</h3>
                <p>Mohon masukan kredensial anda</p>
                <form action="" onSubmit={handleSubmit}>
                    <div className="my-4">
                        {message && (
                            <div className="mb-2 w-full p-2 text-center rounded-md border border-red-300 text-white bg-red-400">
                                {message}
                            </div>
                        )}
                        <div className="my-2">
                            <Label
                                htmlFor="username"
                                className={`${
                                    errors.username ? "text-destructive" : ""
                                }`}
                            >
                                Email
                            </Label>
                            <Input
                                placeholder="example@username.com"
                                type="text"
                                name="username"
                                id="username"
                                value={data.username}
                                onChange={(e) => {
                                    setData("username", e.target.value);
                                    setError("username", null);
                                }}
                                className={`${
                                    errors.username
                                        ? "border-destructive border text-destructive"
                                        : ""
                                }`}
                            />
                            {errors.username && (
                                <p className="text-destructive text-sm">
                                    {errors.username}
                                </p>
                            )}
                        </div>
                        <div className="my-2">
                            <Label
                                htmlFor="password"
                                className={`${
                                    errors.password ? "text-destructive" : ""
                                }`}
                            >
                                Password
                            </Label>
                            <Input
                                type="password"
                                name="password"
                                id="password"
                                value={data.password}
                                placeholder="password"
                                onChange={(e) => {
                                    setData("password", e.target.value);
                                    setError("password", null);
                                }}
                                className={`w-full ${
                                    errors.password
                                        ? "text-destructive border border-destructive"
                                        : ""
                                }`}
                            />
                            {errors.password && (
                                <p className="text-destructive text-sm">
                                    {errors.password}
                                </p>
                            )}
                        </div>
                    </div>
                    <Button
                        type="submit"
                        disabled={processing}
                        className="w-full"
                    >
                        Masuk
                    </Button>
                </form>
            </div>
        </div>
    );
}
