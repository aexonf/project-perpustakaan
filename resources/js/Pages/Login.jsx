import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
} from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Head, useForm } from "@inertiajs/react";
import { cn } from "@/lib/utils";
import React from "react";

export default function Login({ message }) {
    const { data, setData, post, processing, errors, setError } = useForm({
        name: "",
        password: "",
    });
    function submit(e) {
        e.preventDefault();
        post("/login");
    }
    return (
        <>
            <Head title="Login" />
            <div className="w-full flex items-center justify-center h-screen overflow-hidden">
                <Card className="w-full max-w-[500px] z-10 p-0 rounded-3xl md:p-[32px]">
                    <form
                        action="/login"
                        method="post"
                        onSubmit={submit}
                        className="font-jakarta"
                    >
                        <CardHeader>
                            <div>
                                <div className="flex justify-center w-full space-x-4 mb-8">
                                    <img
                                        src="/image/logo.png"
                                        alt="logo"
                                        className="w-20 h-20"
                                    />
                                    <div className="flex justify-center flex-col">
                                        <h2 className="font-semibold text-[20px] leading-8">
                                            SMK NEGERI JATIPURO
                                        </h2>
                                    </div>
                                </div>
                                <h2 className="font-semibold text-2xl text-center tracking-wide">
                                    Perpustakaan
                                </h2>
                            </div>
                            {message && (
                                <Badge
                                    variant={"destructive"}
                                    className="text-sm py-2 px-4 text-center flex items-center justify-center"
                                >
                                    {message}
                                </Badge>
                            )}
                        </CardHeader>
                        <CardContent className="space-y-2">
                            <div
                                className={cn(
                                    "space-y-2 mb-4",
                                    errors.username && "text-destructive"
                                )}
                            >
                                <Label
                                    className="text-xl font-semibold"
                                    htmlFor="username"
                                >
                                    Username
                                </Label>
                                <Input
                                    type="text"
                                    value={data.username}
                                    onChange={(e) => {
                                        setData("username", e.target.value);
                                        setError("username", null);
                                    }}
                                    id="username"
                                    placeholder="Masukkan name anda"
                                    name="username"
                                    className="p-7 text-xl placeholder:text-[#A0A0A0] rounded-[8px]"
                                />
                            </div>
                            <div className="space-y-2">
                                <Label
                                    className="text-xl font-semibold"
                                    htmlFor="password"
                                >
                                    Password
                                </Label>
                                <Input
                                    type="password"
                                    value={data.password}
                                    onChange={(e) =>
                                        setData("password", e.target.value)
                                    }
                                    id="name"
                                    placeholder="Masukkan password"
                                    name="password"
                                    className="p-7 text-xl placeholder:text-[#A0A0A0] rounded-[8px]"
                                />
                            </div>
                        </CardContent>
                        <CardFooter>
                            <Button
                                className="w-full p-6 mt-[32px] text-xl bg-[#0B96F7] "
                                onClick={submit}
                                disabled={
                                    processing ||
                                    !data.username ||
                                    !data.password
                                }
                            >
                                Login
                            </Button>
                        </CardFooter>
                    </form>
                </Card>
            </div>
        </>
    );
}
