import { cn } from "@/lib/utils";
import { Link } from "@inertiajs/react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Menu } from "lucide-react";

import React from "react";

export default function Navbar({ className }) {
    return (
        <nav className={cn("h-[460px] max-h-[460px] relative", className)}>
            <div className="w-full block z-10">
                <div className="flex items-center justify-between mx-auto p-4 md:px-20">
                    <Link
                        className="flex items-center space-x-4 text-white"
                        href="/"
                    >
                        <img src="/image/logo.png" alt="" className="size-16" />
                        <h4 className="text-xl">
                            PERPUSTAKAAN <strong>SMK NEGERI JATIPURO</strong>
                        </h4>
                    </Link>
                    <DropdownMenu>
                        <DropdownMenuTrigger className="md:hidden">
                            <Menu className="text-white" />
                        </DropdownMenuTrigger>
                        <DropdownMenuContent className="md:hidden">
                            <DropdownMenuItem asChild>
                                <Link
                                    href="/"
                                    className={cn(
                                        "text-xl px-4",
                                        window.location.pathname == "/" &&
                                            "bg-primary text-white"
                                    )}
                                >
                                    Beranda
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link
                                    href="/informasi"
                                    className={cn(
                                        "text-xl px-4",
                                        window.location.pathname ==
                                            "/informasi" &&
                                            "bg-primary text-white"
                                    )}
                                >
                                    Informasi
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link
                                    href="/pustakawan"
                                    className={cn(
                                        "text-xl px-4",
                                        window.location.pathname ==
                                            "/pustakawan" &&
                                            "bg-primary text-white"
                                    )}
                                >
                                    Pustakawan
                                </Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem asChild>
                                <Link
                                    href="/login"
                                    className={cn(
                                        "text-xl px-4 font-semibold",
                                        window.location.pathname == "/login" &&
                                            "bg-primary text-white"
                                    )}
                                >
                                    Login
                                </Link>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                    <ul className="font-medium hidden md:flex flex-row items-center space-x-8 mt-0 border-0">
                        <li>
                            <Link
                                href="/"
                                className={cn(
                                    "block py-2 px-3 border-0 p-0",
                                    window.location.pathname === "/"
                                        ? "text-white"
                                        : "text-[#ffffffbf] hover:text-white"
                                )}
                            >
                                Beranda
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/informasi"
                                className={cn(
                                    "block py-2 px-3 border-0 p-0",
                                    window.location.pathname == "/informasi"
                                        ? "text-white"
                                        : "text-[#ffffffbf] hover:text-white"
                                )}
                            >
                                Informasi
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/pustakawan"
                                className={cn(
                                    "block py-2 px-3 border-0 p-0",
                                    window.location.pathname == "/pustakawan"
                                        ? "text-white"
                                        : "text-[#ffffffbf] hover:text-white"
                                )}
                            >
                                Pustakawan
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/login"
                                className={cn(
                                    "block border-0 text-lg bg-primary text-white py-2 px-5 rounded-xl"
                                )}
                            >
                                Login
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <img
                className={cn(
                    "h-full w-screen object-center absolute top-0 z-[-1] brightness-50",
                    className
                )}
                src="/image/perpus.jpg"
                alt="bg-cover"
            />
        </nav>
    );
}
